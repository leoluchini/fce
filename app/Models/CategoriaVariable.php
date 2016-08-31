<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaVariable extends Model
{
    protected $table = 'categorias_variables';
	protected $fillable = ['codigo', 'nombre', 'descripcion', 'categoria_padre_id'];

	public function categoria_padre()
	{
		return $this->belongsTo('App\Models\CategoriaVariable', 'categoria_padre_id', 'id');
	}

	public function subcategorias()
	{
		return $this->hasMany('App\Models\CategoriaVariable', 'categoria_padre_id', 'id');
	}

	public function variables()
	{
		return $this->hasMany('App\Models\Variable', 'categoria_id');
	}
}
