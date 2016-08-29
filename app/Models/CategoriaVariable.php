<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaVariable extends Model
{
    protected $table = 'categorias_variables';
	protected $fillable = ['codigo', 'nombre', 'descripcion'];

	public function categoria_padre()
	{
		return $this->hasOne('App\Models\CategoriaVariable', 'categoria_padre_id');
	}

	public function variables()
	{
		return $this->hasMany('App\Models\Variable', 'categoria_id');
	}
}
