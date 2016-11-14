<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformacionIndicador extends Model
{
    protected $table = 'informacion_indicadores';
	protected $fillable = ['anio', 'valor', 'indicador_id', 'zona_id', 'unidad_medida_id', 'fuente_id', 'frecuencia_id', 'lote_id'];

	public function indicador()
	{
		return $this->hasOne('App\Models\Indicador', 'id', 'indicador_id');
	}
	public function unidad_medida()
	{
		return $this->hasOne('App\Models\UnidadMedida', 'id', 'unidad_medida_id');
	}
	public function frecuencia()
	{
		return $this->hasOne('App\Models\Frecuencia', 'id', 'frecuencia_id');
	}
	public function fuente()
	{
		return $this->hasOne('App\Models\Fuente', 'id', 'fuente_id');
	}
	public function zona()
	{
		return $this->hasOne('App\Models\ZonaGeografica', 'id', 'zona_id');
	}

	public function dato_adicional()
	{
		$dato = InformacionIndicadorDato::where('lote_id',$this->lote_id)->where('indicador_id', $this->indicador_id)->first();
		if($dato){
			return $dato->dato;
		}
		else{
			return false;
		}
	}
}
