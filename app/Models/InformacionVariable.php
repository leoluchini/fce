<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformacionVariable extends Model
{
    protected $table = 'informacion_variables';
	protected $fillable = ['anio', 'valor'];

	public function variable()
	{
		return $this->hasOne('App\Models\Variable', 'variable_id');
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
		return $this->belongsToMany('App\Models\InformacionAdicional', 'informacion_adicional_variables', 'informacion_variable_id', 'informacion_adicional_id');
	}
}
