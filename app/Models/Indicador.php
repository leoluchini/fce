<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    protected $table = 'indicadores';
	protected $fillable = ['codigo', 'nombre', 'descripcion'];

	public function asociacion_rango()
	{
		return $this->hasOne('App\Models\AsociacionRango', 'asociacion_rango_id');
	}

	public function datos()
	{
		return $this->hasMany('App\Models\InformacionIndicador', 'indicador_id');
	}
}
