<?php

namespace App;

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

class ProcesarArchivo
{
    public function fire($job, $data)
    {
        $lote = $data['lote'];
        $lote->update(['estado' => Lote::ESTADO_PROCESANDO]);
        if($lote->tipo == 'variable'){
            $datos = txt_to_array($lote->archivo);
        }
        else{
            $datos = txt_indicadores_to_array($lote->archivo);
        }
        $references = [];
        //if( sizeof( array_keys($datos) ) == 5 )
        if( sizeof( array_keys($datos) ) <= 4 )
        { 
            $lote->update([
                'estado' => Lote::ESTADO_ERROR,
                'error' => "Faltan claves para definir la informacion"
            ]);
            return false;
        }

        try {
            if($lote->tipo == 'variable'){
                foreach ($datos['#Categorias'] as $attributes){
                    $attributes['lote_id'] = $lote->id;
                    $object = CategoriaVariable::firstOrCreate($attributes);
                    $references[$object->codigo] = $object->id;
                    unset($object);
                }
                foreach ($datos['#Variables'] as $attributes){
                    $attributes['lote_id'] = $lote->id;
                    $object = Variable::firstOrCreate($attributes);
                    $references[$object->codigo] = $object->id;
                    unset($object);
                }
            }
            else{
                foreach ($datos['#Categorias'] as $attributes){
                    $attributes['lote_id'] = $lote->id;
                    $object = CategoriaIndicador::firstOrCreate($attributes);
                    $references[$object->codigo] = $object->id;
                    unset($object);
                }
                foreach ($datos['#Indicadores'] as $attributes){
                    $attributes['lote_id'] = $lote->id;
                    $object = Indicador::firstOrCreate($attributes);
                    $references[$object->codigo] = $object->id;
                    unset($object);
                }
            }
            foreach ($datos['#Zonas'] as $attributes) {
                $attributes['lote_id'] = $lote->id;
                $object = ZonaGeografica::firstOrCreate($attributes);
                $references[$object->codigo] = $object->id;
                unset($object);
            }
            foreach ($datos['#Unidades'] as $attributes){
                $attributes['lote_id'] = $lote->id;
                $object = UnidadMedida::firstOrCreate($attributes);
                $references[$object->codigo] = $object->id;
                unset($object);
            }
            foreach ($datos['#Fuentes'] as $attributes) {
                $attributes['lote_id'] = $lote->id;
                $object = Fuente::firstOrCreate($attributes);
                $references[$object->codigo] = $object->id;
                unset($object);
            }
            if(isset($datos['#DatosAdicionales'])){
                foreach ($datos['#DatosAdicionales'] as $id => $dato) {
                    $attributes['lote_id'] = $lote->id;
                    $attributes['dato'] = $dato;
                    if($lote->tipo == 'variable'){
                        $attributes['variable_id'] = $references[$id];
                        InformacionVariableDato::create($attributes);
                    }
                    else{
                        $attributes['indicador_id'] = $references[$id];
                        InformacionIndicadorDato::create($attributes);
                    }
                }
            }
           
            $resultado = array_chunk($datos['#Datos'], 5000);
            
            foreach ($resultado as $value) {
                \Queue::push('App\ProcesarArchivo@guardarDatos', [
                    'datos' => $value, 
                    'references' => $references,
                    'lote' => $lote,
                ]);
            }
            
            \Queue::push('App\ProcesarArchivo@finalizarLote', [
                'lote' => $lote
            ]);
            unlink($lote->archivo);
        } catch (\Exception $e) {
            $lote->update([
                'estado' => Lote::ESTADO_ERROR,
                'error' => "Error al procesar el archivo, revise que esté correctamente escrito y vuelva a intentarlo."
            ]);
            
        }
        $job->delete();
    }

    public function guardarDatos($job, $datos)
    {
        $lote = $datos['lote'];
        $references = $datos['references'];
        foreach ($datos['datos'] as $attributes) {
            $attributes['lote_id'] = $lote->id;
            $attributes['zona_id'] = $references[$attributes['zona_id']];
            $attributes['fuente_id'] = $references[$attributes['fuente_id']];
            $attributes['unidad_medida_id'] = $references[$attributes['unidad_medida_id']];
            $attributes['frecuencia_id'] = Frecuencia::where('codigo', $attributes['frecuencia_id'])->first()->id;
            if($lote->tipo == 'variable'){
                $attributes['variable_id'] = $references[$attributes['variable_id']];
                InformacionVariable::create($attributes);
            }
            else{
                $attributes['indicador_id'] = $references[$attributes['indicador_id']];
                InformacionIndicador::create($attributes);
            }
        }
        $job->delete();
    }

    public function finalizarLote($job, $datos)
    {
        $lote = $datos['lote'];
        if($lote->estado ==  Lote::ESTADO_PROCESANDO)
        {
            $lote->update(['estado' => Lote::ESTADO_FINALIZADO]);
        }
        $job->delete(); 
    }
}
