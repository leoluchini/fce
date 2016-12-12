<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LecturaRequest;
use App\Jobs\ProcesarArchivo;
use App\Http\Requests;
use App\Models\CategoriaVariable;
use App\Models\Fuente;
use App\Models\UnidadMedida;
use App\Models\Variable;
use App\Models\ZonaGeografica;
use App\Models\LoteVariable;
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
            $lotes = LoteVariable::orderBy('id')->paginate(25);
            $fechas = null;
        }
        else{
            if( ($request->get('fecha_desde') != '') && ($request->get('fecha_hasta') != '') ){
                $lotes = LoteVariable::whereDate('created_at', '>=', $request->get('fecha_desde'))
                            ->whereDate('created_at', '<=', $request->get('fecha_hasta'))
                            ->orderBy('id')->paginate(25);
                $fechas = ['desde' => $request->get('fecha_desde'), 'hasta' => $request->get('fecha_hasta')];
            }
            else{
                $operador = ($request->get('fecha_desde') != '') ? '>=' : '<=';
                $valor = ($request->get('fecha_desde') != '') ? $request->get('fecha_desde') : $request->get('fecha_hasta');
                ($request->get('fecha_desde') != '') ? $fechas['desde'] = $valor : $fechas['hasta'] = $valor;
                $lotes = LoteVariable::whereDate('created_at', $operador, $valor)
                            ->orderBy('id')->paginate(25);
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
        $lote = LoteVariable::findOrFail($id);

        
        return view('lectura.show', ['lote' => $lote]);
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
            $lote = LoteVariable::create([
                'archivo' => $filename.'.txt',
                'usuario_id' => \Auth::user()->id
            ]);

            \Queue::push('App\ProcesarArchivo', array('lote' => $lote));
        }

        return redirect(route('administracion.lectura.index'));
    }

    public function destroy($id){
        $lote = LoteVariable::findOrFail($id);
        $lote->delete();
         return redirect(route('administracion.lectura.index'));
    }

    public function cambiar_estado($id)
    {
        $lote = LoteVariable::findOrFail($id);
        if($lote->estado == LoteVariable::ESTADO_FINALIZADO){
            $lote->update(['estado' => LoteVariable::ESTADO_ACEPTADO]);
        }
        else{
            $lote->update(['estado' => LoteVariable::ESTADO_FINALIZADO]);
        }
        return redirect('administracion/lectura/'.$id);
    }
    
    public function categorias($id)
    {
        $lote = LoteVariable::findOrFail($id);
        $info = CategoriaVariable::where('lote_id', '=', $id)->paginate(25);
        return view('lectura.categorias', ['lote' => $lote, 'categorias' => $info]);
    } 

    public function variables($id)
    {
        $lote = LoteVariable::findOrFail($id);
        $info = Variable::where('lote_id', '=', $id)->paginate(25);
        return view('lectura.variables', ['lote' => $lote, 'variables' => $info]);
    }

    public function unidades($id)
    {
        $lote = LoteVariable::findOrFail($id);
        $info = UnidadMedida::where('lote_id', '=', $id)->paginate(25);
        return view('lectura.unidades', ['lote' => $lote, 'unidades' => $info]);
    }

    public function zonas($id)
    {
        $lote = LoteVariable::findOrFail($id);
        $info = ZonaGeografica::where('lote_id', '=', $id)->paginate(25);
        return view('lectura.zonas', ['lote' => $lote, 'zonas' => $info]);
    }

    public function fuentes($id)
    {
        $lote = LoteVariable::findOrFail($id);
        $info = Fuente::where('lote_id', '=', $id)->paginate(25);
        return view('lectura.fuentes', ['lote' => $lote, 'fuentes' => $info]);
    }
    
    public function datos($id)
    {
        $lote = LoteVariable::findOrFail($id);
        $info = InformacionVariable::where('lote_id', '=', $id)->paginate(25);
        return view('lectura.datos', ['lote' => $lote, 'datos' => $info]);
    }
}
