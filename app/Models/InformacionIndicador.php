<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformacionIndicador extends Model
{
    protected $table = 'informacion_indicadores';
	protected $fillable = ['anio', 'valor'];

	public function indicador()
	{
		return $this->hasOne('App\Models\Indicador', 'indicador_id');
	}
	public function unidad_medida()
	{
		return $this->hasOne('App\Models\UnidadMedida', 'unidad_medida_id');
	}
	public function frecuencia()
	{
		return $this->hasOne('App\Models\Frecuencia', 'frecuencia_id');
	}
	public function fuente()
	{
		return $this->hasOne('App\Models\Fuente', 'fuente_id');
	}
	public function zona()
	{
		return $this->hasOne('App\Models\Zona', 'zona_id');
	}

	public function informacion_adicional()
	{
		return $this->belongsToMany('App\Models\InformacionAdicional', 'informacion_adicional_indicadores', 'informacion_indicador_id', 'informacion_adicional_id');
	}
}
