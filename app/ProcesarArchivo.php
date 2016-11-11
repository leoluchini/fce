<?php

namespace App;

use App\Models\CategoriaVariable;
use App\Models\Frecuencia;
use App\Models\Fuente;
use App\Models\InformacionVariable;
use App\Models\Lote;
use App\Models\Variable;
use App\Models\UnidadMedida;
use App\Models\ZonaGeografica;

class ProcesarArchivo
{
    public function fire($job, $data)
    {
        $lote = $data['lote'];
        $lote->update(['estado' => Lote::ESTADO_PROCESANDO]);
        
        $datos = txt_to_array($lote->archivo);
        $references = [];
        if( sizeof( array_keys($datos) ) == 5 )
        { 
            $lote->update([
                'estado' => Lote::ESTADO_ERROR,
                'error' => "Faltan claves para definir la informacion"
            ]);
            return false;
        }

        try {
            foreach ($datos['#Categorias'] as $attributes){
                $attributes['lote_id'] = $lote->id;
                $object = CategoriaVariable::firstOrCreate($attributes);
                $references[strtolower($object->codigo)] = $object->id;
                unset($object);
            }
            foreach ($datos['#Variables'] as $attributes){
                $attributes['lote_id'] = $lote->id;
                $object = Variable::firstOrCreate($attributes);
                $references[strtolower($object->codigo)] = $object->id;
                unset($object);
            }
            foreach ($datos['#Zonas'] as $attributes) {
                $attributes['lote_id'] = $lote->id;
                $object = ZonaGeografica::firstOrCreate($attributes);
                $references[strtolower($object->codigo)] = $object->id;
                unset($object);
            }
            foreach ($datos['#Unidades'] as $attributes){
                $attributes['lote_id'] = $lote->id;
                $object = UnidadMedida::firstOrCreate($attributes);
                $references[strtolower($object->codigo)] = $object->id;
                unset($object);
            }
            foreach ($datos['#Fuentes'] as $attributes) {
                $attributes['lote_id'] = $lote->id;
                $object = Fuente::firstOrCreate($attributes);
                $references[strtolower($object->codigo)] = $object->id;
                unset($object);
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
            $attributes['variable_id'] = $references[strtolower($attributes['variable_id'])];
            $attributes['zona_id'] = $references[strtolower($attributes['zona_id'])];
            $attributes['fuente_id'] = $references[strtolower($attributes['fuente_id'])];
            $attributes['unidad_medida_id'] = $references[strtolower($attributes['unidad_medida_id'])];
            $attributes['frecuencia_id'] = Frecuencia::where('codigo', $attributes['frecuencia_id'])->first()->id;
            InformacionVariable::create($attributes);
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