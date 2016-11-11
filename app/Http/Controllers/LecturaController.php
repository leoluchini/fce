<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LecturaRequest;
use App\Jobs\ProcesarArchivo;
use App\Http\Requests;
use App\Models\Lote;
use App\Models\InformacionVariable;
use Illuminate\Support\Facades\DB;

class LecturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        if( ($request->get('fecha_desde') == '') && ($request->get('fecha_hasta') == '') ){
            $lotes = Lote::orderBy('id')->paginate(50);
            $fechas = null;
        }
        else{
            if( ($request->get('fecha_desde') != '') && ($request->get('fecha_hasta') != '') ){
                $lotes = Lote::whereDate('created_at', '>=', $request->get('fecha_desde'))
                            ->whereDate('created_at', '<=', $request->get('fecha_hasta'))
                            ->orderBy('id')->paginate(50);
                $fechas = ['desde' => $request->get('fecha_desde'), 'hasta' => $request->get('fecha_hasta')];
            }
            else{
                $operador = ($request->get('fecha_desde') != '') ? '>=' : '<=';
                $valor = ($request->get('fecha_desde') != '') ? $request->get('fecha_desde') : $request->get('fecha_hasta');
                ($request->get('fecha_desde') != '') ? $fechas['desde'] = $valor : $fechas['hasta'] = $valor;
                $lotes = Lote::whereDate('created_at', $operador, $valor)
                            ->orderBy('id')->paginate(50);
            }
            $lotes->appends(['fecha_desde' => $request->get('fecha_desde'), 'fecha_hasta' => $request->get('fecha_hasta')]);
        }

        return view('lectura.index',  ['lotes' => $lotes, 'fechas' => $fechas]);
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

    public function cambiar_estado($id)
    {
        $lote = Lote::findOrFail($id);
        if($lote->estado == 3){
            $lote->update(['estado' => 4]);
        }
        else{
            $lote->update(['estado' => 3]);
        }
        return redirect('administracion/lectura/'.$id);
    }
}
