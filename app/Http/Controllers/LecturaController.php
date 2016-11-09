<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LecturaRequest;

use App\Http\Requests;
use App\Models\CategoriaVariable;
use App\Models\Frecuencia;
use App\Models\Fuente;
use App\Models\InformacionVariable;
use App\Models\Lote;
use App\Models\Variable;
use App\Models\UnidadMedida;
use App\Models\ZonaGeografica;
use Illuminate\Support\Facades\DB;

class LecturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $lotes = Lote::all();
        return view('lectura.index')->withLotes($lotes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create()
    {
        return view('lectura.create');
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function store(LecturaRequest $request)
    {
        if ($request->hasFile('file')) {
            $request->file('file')->move(public_path('storage'), 'carga.csv');
            $lote = Lote::create();
            //TODO analizar si pasarlo a JOBs
            $this->lectura($lote);
        }
        return redirect(route('administracion.lectura.show', $lote->id));
    }*/

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lote = Lote::findOrFail($id);

        $cantidad = DB::table('informacion_variables')
                 ->select(DB::raw('count(*) as cantidad'))
                 ->where('lote_id', '=', $id)
                 ->get();
        $cantidad_datos = $cantidad[0]->cantidad;
        
        return view('lectura.show', ['lote' => $lote, 'cantidad' => $cantidad_datos]);
        //return view('lectura.show')->withLote($lote);
    }

    public function datos_lote($id)
    {
        $lote = Lote::findOrFail($id);
        $info = InformacionVariable::where('lote_id', '=', $id)->paginate(500);
        return view('lectura.datos', ['lote' => $lote, 'datos' => $info]);
        //return view('lectura.datos')->withLote($lote);
    }

    public function destroy($id){
        $lote = Lote::findOrFail($id);
        $lote->delete();
         return redirect(route('administracion.lectura.index'));
    }

    private function lectura($lote){
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 123456);
        $csvFile = public_path().'/storage/carga.csv';
        $datos = csv_to_array($csvFile);
        $references = [];
        if( sizeof( array_keys($datos) ) == 5 ) 
            return "Faltan claves para definir la informacion";
        try {
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
            foreach ($datos['#Datos'] as $attributes) {
                $attributes['lote_id'] = $lote->id;
                $attributes['variable_id'] = $references[$attributes['variable_id']];
                $attributes['zona_id'] = $references[$attributes['zona_id']];
                $attributes['fuente_id'] = $references[$attributes['fuente_id']];
                $attributes['unidad_medida_id'] = $references[$attributes['unidad_medida_id']];
                $attributes['frecuencia_id'] = Frecuencia::where('codigo', $attributes['frecuencia_id'])->first()->id;
                InformacionVariable::create($attributes);
            }
            //TODO borrar archivo
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

    public function create()
    {
        return view('lectura.create');
    }

    public function store(LecturaRequest $request)
    {
        if ($request->hasFile('file')) {
            $request->file('file')->move(public_path('storage'), 'carga.txt');
            $lote = Lote::create();
            $this->lectura_txt($lote);
        }
        return redirect(route('administracion.lectura.show', $lote->id));
    }
    private function lectura_txt($lote){
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 123456);
        $csvFile = public_path().'/storage/carga.txt';
        $datos = txt_to_array($csvFile);
        $references = [];
        if( sizeof( array_keys($datos) ) == 5 ) 
            return "Faltan claves para definir la informacion";
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
            foreach ($datos['#Datos'] as $attributes) {
                $attributes['lote_id'] = $lote->id;
                $attributes['variable_id'] = $references[strtolower($attributes['variable_id'])];
                $attributes['zona_id'] = $references[strtolower($attributes['zona_id'])];
                $attributes['fuente_id'] = $references[strtolower($attributes['fuente_id'])];
                $attributes['unidad_medida_id'] = $references[strtolower($attributes['unidad_medida_id'])];
                $attributes['frecuencia_id'] = Frecuencia::where('codigo', $attributes['frecuencia_id'])->first()->id;
                InformacionVariable::create($attributes);
            }
            //TODO borrar archivo
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
}
