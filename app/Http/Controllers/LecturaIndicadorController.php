<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LecturaRequest;
use App\Jobs\ProcesarArchivo;
use App\Http\Requests;
use App\Models\LoteIndicador;
use App\Models\CategoriaIndicador;
use App\Models\Fuente;
use App\Models\UnidadMedida;
use App\Models\Indicador;
use App\Models\ZonaGeografica;
use App\Models\InformacionIndicador;
use Illuminate\Support\Facades\DB;

class LecturaIndicadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        if( ($request->get('fecha_desde') == '') && ($request->get('fecha_hasta') == '') ){
            $lotes = LoteIndicador::orderBy('id')->paginate(25);
            $fechas = null;
        }
        else{
            if( ($request->get('fecha_desde') != '') && ($request->get('fecha_hasta') != '') ){
                $lotes = LoteIndicador::whereDate('created_at', '>=', $request->get('fecha_desde'))
                            ->whereDate('created_at', '<=', $request->get('fecha_hasta'))
                            ->orderBy('id')->paginate(25);
                $fechas = ['desde' => $request->get('fecha_desde'), 'hasta' => $request->get('fecha_hasta')];
            }
            else{
                $operador = ($request->get('fecha_desde') != '') ? '>=' : '<=';
                $valor = ($request->get('fecha_desde') != '') ? $request->get('fecha_desde') : $request->get('fecha_hasta');
                ($request->get('fecha_desde') != '') ? $fechas['desde'] = $valor : $fechas['hasta'] = $valor;
                $lotes = LoteIndicador::whereDate('created_at', $operador, $valor)
                            ->orderBy('id')->paginate(25);
            }
            $lotes->appends(['fecha_desde' => $request->get('fecha_desde'), 'fecha_hasta' => $request->get('fecha_hasta')]);
        }

        return view('lectura_indicadores.index',  ['lotes' => $lotes, 'fechas' => $fechas]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lote = LoteIndicador::findOrFail($id);

        $cantidad_datos = $this->contar_datos($id);
        
        return view('lectura_indicadores.show', ['lote' => $lote, 'cantidad' => $cantidad_datos]);
    }

    public function create()
    {
        return view('lectura_indicadores.create');
    }

    public function store(LecturaRequest $request)
    {
        if ($request->hasFile('file')) {

            $date = new \DateTime();
            $filename = $date->format('d_m_Y_H_i_s');
            $request->file('file')->move(public_path('storage'), $filename.'.txt');
            $lote = LoteIndicador::create([
                'archivo' => $filename.'.txt',
                'usuario_id' => \Auth::user()->id
            ]);

            \Queue::push('App\ProcesarArchivo', array('lote' => $lote));
        }

        return redirect(route('administracion.lectura_indicador.index'));
    }

    public function destroy($id){
        $lote = LoteIndicador::findOrFail($id);
        $lote->delete();
         return redirect(route('administracion.lectura_indicador.index'));
    }

    public function cambiar_estado($id)
    {
        $lote = LoteIndicador::findOrFail($id);
        if($lote->estado == LoteIndicador::ESTADO_FINALIZADO){
            $lote->update(['estado' => LoteIndicador::ESTADO_ACEPTADO]);
        }
        else{
            $lote->update(['estado' => LoteIndicador::ESTADO_FINALIZADO]);
        }
        return redirect('administracion/lectura_indicador/'.$id);
    }
    
    public function categorias($id)
    {
        $lote = LoteIndicador::findOrFail($id);
        $info = CategoriaIndicador::where('lote_id', '=', $id)->paginate(25);
        $cantidad_datos = $this->contar_datos($id);
        return view('lectura_indicadores.categorias', ['lote' => $lote, 'categorias' => $info, 'cantidad' => $cantidad_datos]);
    } 

    public function indicadores($id)
    {
        $lote = LoteIndicador::findOrFail($id);
        $info = Indicador::where('lote_id', '=', $id)->paginate(25);
        $cantidad_datos = $this->contar_datos($id);
        return view('lectura_indicadores.indicadores', ['lote' => $lote, 'indicadores' => $info, 'cantidad' => $cantidad_datos]);
    }

    public function unidades($id)
    {
        $lote = LoteIndicador::findOrFail($id);
        $info = UnidadMedida::where('lote_id', '=', $id)->paginate(25);
        $cantidad_datos = $this->contar_datos($id);
        return view('lectura_indicadores.unidades', ['lote' => $lote, 'unidades' => $info, 'cantidad' => $cantidad_datos]);
    }

    public function zonas($id)
    {
        $lote = LoteIndicador::findOrFail($id);
        $info = ZonaGeografica::where('lote_id', '=', $id)->paginate(25);
        $cantidad_datos = $this->contar_datos($id);
        return view('lectura_indicadores.zonas', ['lote' => $lote, 'zonas' => $info, 'cantidad' => $cantidad_datos]);
    }

    public function fuentes($id)
    {
        $lote = LoteIndicador::findOrFail($id);
        $info = Fuente::where('lote_id', '=', $id)->paginate(25);
        $cantidad_datos = $this->contar_datos($id);
        return view('lectura_indicadores.fuentes', ['lote' => $lote, 'fuentes' => $info, 'cantidad' => $cantidad_datos]);
    }
    
    public function datos($id)
    {
        $lote = LoteIndicador::findOrFail($id);
        $info = InformacionIndicador::where('lote_id', '=', $id)->paginate(25);
        $cantidad_datos = $this->contar_datos($id);
        return view('lectura_indicadores.datos', ['lote' => $lote, 'datos' => $info, 'cantidad' => $cantidad_datos]);
    }

    protected function contar_datos($id)
    {
        $cantidad = DB::table('informacion_indicadores')
                 ->select(DB::raw('count(*) as cantidad'))
                 ->where('lote_id', '=', $id)
                 ->get();
        return $cantidad[0]->cantidad;
    }
}
