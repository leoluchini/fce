<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
    protected $table = 'variables';
	protected $fillable = ['codigo', 'nombre', 'descripcion', 'categoria_id'];

	public function asociacion_rango()
	{
		return $this->hasOne('App\Models\AsociacionRango', 'asociacion_rango_id');
	}

	public function datos()
	{
		return $this->hasMany('App\Models\InformacionVAriable', 'variable_id');
	}

	public function categoria()
	{
		return $this->belongsTo('App\Models\CategoriaVariable', 'categoria_id');
	}
}
