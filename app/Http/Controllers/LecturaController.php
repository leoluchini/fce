<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LecturaRequest;
use App\Jobs\ProcesarArchivo;
use App\Http\Requests;
use App\Models\Lote;
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
    }

    public function create()
    {
        return view('lectura.create');
    }

    public function store(LecturaRequest $request)
    {
        if ($request->hasFile('file')) {

            $date = new \DateTime();
            $filename = $date->format('d_m_Y_H_i_s');
            $request->file('file')->move(public_path('storage'), $filename.'.txt');
            $lote = Lote::create([
                'archivo' => $filename.'.txt',
                'usuario_id' => \Auth::user()->id
            ]);

            \Queue::push('App\ProcesarArchivo', array('lote' => $lote));
        }

        return redirect(route('administracion.lectura.index'));
    }
    
    public function datos_lote($id)
    {
        $lote = Lote::findOrFail($id);
        $info = InformacionVariable::where('lote_id', '=', $id)->paginate(500);
        return view('lectura.datos', ['lote' => $lote, 'datos' => $info]);
    }

    public function destroy($id){
        $lote = Lote::findOrFail($id);
        $lote->delete();
         return redirect(route('administracion.lectura.index'));
    }

}
