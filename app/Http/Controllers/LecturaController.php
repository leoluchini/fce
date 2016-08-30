<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\CategoriaVariable;
use App\Models\Fuente;
use App\Models\InformacionVariable;
use App\Models\Variable;
use App\Models\UnidadMedida;
use App\Models\ZonaGeografica;

class LecturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $csvFile = public_path().'/storage/carga.csv';
        $datos = csv_to_array($csvFile);
        $references = [];
        if( sizeof( array_keys($datos) ) == 5 ) 
            return "Faltan claves para definir la informacion";
        try {
            foreach ($datos['#Categorias'] as $attributes){
                $object = CategoriaVariable::firstOrCreate($attributes);
                $references[$object->codigo] = $object->id;
                unset($object);
            }
            foreach ($datos['#Variables'] as $attributes){
                $object = Variable::firstOrCreate($attributes);
                $references[$object->codigo] = $object->id;
                unset($object);
            }
            foreach ($datos['#Zonas'] as $attributes) {
                $object = ZonaGeografica::firstOrCreate($attributes);
                $references[$object->codigo] = $object->id;
                unset($object);
            }
            foreach ($datos['#Unidades'] as $attributes){
                $object = UnidadMedida::firstOrCreate($attributes);
                $references[$object->codigo] = $object->id;
                unset($object);
            }
            foreach ($datos['#Fuentes'] as $attributes) {
                $object = Fuente::firstOrCreate($attributes);
                $references[$object->codigo] = $object->id;
                unset($object);
            }
            foreach ($datos['#Datos'] as $attributes) {
                $attributes['variable_id'] = $references[$attributes['variable_id']];
                $attributes['zona_id'] = $references[$attributes['zona_id']];
                $attributes['fuente_id'] = $references[$attributes['fuente_id']];
                $attributes['unidad_medida_id'] = $references[$attributes['unidad_medida_id']];
                $attributes['frecuencia_id'] = 1;
                InformacionVariable::create($attributes);
            }
        } catch (\Exception $e) {
            //TODO analizar si borrar el lote
            $message = $e->getMessage();
            if (strpos($message, 'index') !== false) {
               return "Error al procesar el indice ".explode(":", $message)[1]." revise que esté correctamente escrito y vuelva a intentarlo.";
            }else{
                return $message;
            }   
            
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
