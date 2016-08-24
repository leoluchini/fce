<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaIndicador extends Model
{
    protected $table = 'categorias_indicadores';
	protected $fillable = ['codigo', 'nombre', 'descripcion'];

	public function categoria_padre()
	{
		return $this->hasOne('App\Models\CategoriaIndicador', 'categoria_padre_id');
	}

	public function indicadores()
	{
		return $this->hasMany('App\Models\Indicador', 'categoria_id');
	}
}
