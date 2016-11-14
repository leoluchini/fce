<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaIndicador extends Model
{
    protected $table = 'categorias_indicadores';
    
	protected $fillable = ['codigo', 'nombre', 'descripcion', 'categoria_padre_id', 'lote_id'];

	public static function firstOrCreate(array $attributes)
	{
		if ( ! is_null($instance = self::where('codigo',$attributes['codigo'])->first()))
		{
			return $instance;
		}
		return self::create($attributes);
	}

	public function categoria_padre()
	{
		return $this->hasOne('App\Models\CategoriaIndicador', 'categoria_padre_id', 'id');
	}

	public function subcategorias()
	{
		return $this->hasMany('App\Models\CategoriaIndicador', 'categoria_padre_id', 'id')->orderBy('id', 'ASC');
	}

	public function indicadores()
	{
		return $this->hasMany('App\Models\Indicador', 'categoria_id')->orderBy('id', 'ASC');
	}
}
