<?php

namespace App\Jobs;

use App\Jobs\Job;

use App\Models\CategoriaVariable;
use App\Models\CategoriaIndicador;
use App\Models\Frecuencia;
use App\Models\Fuente;
use App\Models\InformacionVariable;
use App\Models\InformacionIndicador;
use App\Models\InformacionVariableDato;
use App\Models\InformacionIndicadorDato;
use App\Models\Lote;
use App\Models\Variable;
use App\Models\Indicador;
use App\Models\UnidadMedida;
use App\Models\ZonaGeografica;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Facades\Log;

class ProcesarArchivoVariable extends Job implements ShouldQueue, SelfHandling
{
    use InteractsWithQueue, SerializesModels;

    protected $lote;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Lote $lote)
    {
        $this->lote = $lote;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Inicia el proceso del lote: '. $this->lote->id); 
        if( $this->lote->estado == Lote::ESTADO_PROCESANDO)
        {
            $this->error();
            return false;
        }

        $this->actualizarLote(['estado' => Lote::ESTADO_PROCESANDO]);
        $datos = txt_to_array($this->lote->archivo);
        $references = [];

        if( sizeof( array_keys($datos) ) <= 4 )
        { 
            Log::info('Fallo el proceso del lote '. $this->lote->id . 'faltan claves');
            $this->actualizarLote([
                'estado' => Lote::ESTADO_ERROR,
                'error' => "Faltan claves para definir la informaci&oacute;n"
            ]);
            return false;
        }

        list($estado, $errores) = $this->preCheck($datos);

        if(!$estado)
        {
            $this->actualizarLote([
                'estado' => Lote::ESTADO_ERROR,
                'error' => implode(' - ', $errores)
            ]);

            return false;
        }

        try {
            $references = $this->procesarCabecera('App\Models\CategoriaVariable', $datos['#Categorias'], $references);
            $references = $this->procesarCabecera('App\Models\Variable', $datos['#Variables'], $references);
            $references = $this->procesarCabecera('App\Models\ZonaGeografica',$datos['#Zonas'], $references, true);
            $references = $this->procesarCabecera('App\Models\UnidadMedida', $datos['#Unidades'], $references, true);
            $references = $this->procesarCabecera('App\Models\Fuente', $datos['#Fuentes'], $references, true);
            
            if(isset($datos['#DatosAdicionales'])){
                foreach ($datos['#DatosAdicionales'] as $id => $dato) {
                    $attributes['lote_id'] = $this->lote->id;
                    $attributes['dato'] = $dato;
                    
                    $attributes['variable_id'] = $references[$id];
                    InformacionVariableDato::create($attributes);
                }
            }

            $this->procesarDatos($datos['#Datos'],$references);
            
            unlink($this->lote->archivo);
            
            if($this->lote->estado ==  Lote::ESTADO_PROCESANDO)
            {
                $this->actualizarLote(['estado' => Lote::ESTADO_FINALIZADO]);
                Log::info('Finaliza el proceso del lote: '. $this->lote->id); 
            }

        } 
        catch ( \Exception $e) {
            $this->error();
        }
        catch( Symfony\Component\Debug\Exception\FatalErrorException $e) {
            $this->error($e->getMessage());
            Log::error($e);
        }
        
    }

    protected function procesarCabecera($class, $datos, $references, $downcase = false){
        $count = 0;
        $loteId = $this->lote->id;
        foreach ($datos as $attributes){
            $attributes['lote_id'] = $loteId;
            $object = $class::firstOrCreate($attributes);
            $codigo = $downcase ? strtolower($object->codigo) : $object->codigo;
            $references[$codigo] = $object->id;
            $count ++;
        }
        Log::info($class . " procesada con ". $count . " registros");
        return $references;
    }    

    protected function procesarDatos($datos, $references)
    {
        $count = 0;
        $loteId = $this->lote->id;
        foreach ($datos as $attributes) {
            $attributes['lote_id'] = $loteId;
            $attributes['zona_id'] = $references[strtolower($attributes['zona_id'])];
            $attributes['fuente_id'] = $references[strtolower($attributes['fuente_id'])];
            $attributes['unidad_medida_id'] = $references[strtolower($attributes['unidad_medida_id'])];
            $attributes['frecuencia_id'] = Frecuencia::where('codigo', $attributes['frecuencia_id'])->first()->id;
            $attributes['variable_id'] = $references[$attributes['variable_id']];
            InformacionVariable::firstOrCreate($attributes);
            $count ++;
        }
        Log::info($count . " datos procesados para el Lote ". $loteId);
    }

    protected function actualizarLote($attributes)
    {
        $this->lote->update($attributes);
    }

    protected function error()
    {
        $mensaje = "Error al procesar el archivo, revise que esté correctamente escrito y vuelva a intentarlo."; 
            
        Log::info("Error en Lote " . $this->lote->id );
        
        $this->actualizarLote([
            'estado' => Lote::ESTADO_ERROR,
            'error' => $mensaje
        ]);
    }

    protected function preCheck($datos)
    {
        $categorias = array_column($datos['#Categorias'], 'codigo');
        $check_categorias = array_filter($categorias, create_function('$value', 'return strpos($value, "-") !== false;'));
        if(count($check_categorias) > 0){
            return [false, ['Los codigos de categorias no pueden contener el caracter \'-\'']];
        }

        $items = array_column($datos['#Variables'], 'codigo');

        $zonas = array_map('strtolower', array_column($datos['#Zonas'], 'codigo'));

        $unidades = array_map('strtolower', array_column($datos['#Unidades'], 'codigo'));

        $fuentes = array_map('strtolower', array_column($datos['#Fuentes'], 'codigo'));

        $check_variables = array_filter($items, create_function('$value', 'return count(explode("-", $value)) == 2;'));
        if(count($check_variables) != count($items)){
            return [false, ['Los codigos de variables deben contener un unico separador  \'-\'']];
        }

        $temas = array_column($datos['#Variables'], 'tema');
        if(count($temas) > 0){
            $check_temas = array_filter($temas, create_function('$value', 'return count(explode("_", $value)) == 2;'));
            if(count($check_temas) != count($temas)){
                return [false, ['Los temas de variables deben contener un unico separador  \'_\'']];
            }
        }

        $check_zonas = array_filter($zonas, create_function('$value', 'return strlen($value) == 7;'));
        if(count($check_zonas) != count($zonas)){
            return [false, ['Los codigos de zonas geograficas deben ser de 7 caracteres']];
        }
        $check_zonas_2 = array_filter($zonas, create_function('$value', '$pais = substr($value, 0, 2);$provincia = substr($value, 2, 2);$municipio = substr($value, 4, 3);return ($provincia == "00") && ($municipio != "000");'));
        if(count($check_zonas_2) > 0){
            return [false, ['Existen codigos de zonas geograficas que no cumplen la nomenclatura']];
        }

        $info_items = array_unique(array_column($datos['#Datos'], 'variable_id'));

        $info_zonas = array_map('strtolower', array_unique(array_column($datos['#Datos'], 'zona_id')));
        
        $info_unidades = array_map('strtolower', array_unique(array_column($datos['#Datos'], 'unidad_medida_id')));
        
        $info_fuentes = array_map('strtolower', array_unique(array_column($datos['#Datos'], 'fuente_id')));

        $diff_items = array_diff($info_items, $items);
        $diff_zonas = array_diff($info_zonas, $zonas);
        $diff_unidades = array_diff($info_unidades, $unidades);
        $diff_fuentes = array_diff($info_fuentes, $fuentes);
        $diff_items = array_filter($diff_items, create_function('$value', 'return $value !== "";'));
        $diff_zonas = array_filter($diff_zonas, create_function('$value', 'return $value !== "";'));
        $diff_unidades = array_filter($diff_unidades, create_function('$value', 'return $value !== "";'));
        $diff_fuentes = array_filter($diff_fuentes, create_function('$value', 'return $value !== "";'));

        if((count($diff_items) == 0)&&(count($diff_zonas) == 0)&&(count($diff_unidades) == 0)&&(count($diff_fuentes) == 0))
        {
            return [ true, []];
        }
        else{
            $errores = [];
            if((count($diff_items) != 0)){
                $errores[] = 'Variables no definidas en la seccion de catalogos: '.implode(', ', $diff_items);
            }
            if(count($diff_zonas) != 0){
                $errores[] = 'Regiones no definidas en la seccion de catalogos: '.implode(', ', $diff_zonas);
            }
            if(count($diff_unidades) != 0){
                $errores[] = 'Unidades no definidas en la seccion de catalogos: '.implode(', ', $diff_unidades);
            }
            if(count($diff_fuentes) != 0){
                $errores[] = 'Fuentes no definidas en la seccion de catalogos: '.implode(', ', $diff_fuentes);
            }
            return [false, $errores];
        }
    }
}