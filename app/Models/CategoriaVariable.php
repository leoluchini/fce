<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaVariable extends Model
{
    protected $table = 'categorias_variables';
	protected $fillable = ['codigo', 'nombre', 'descripcion'];
	
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
		return $this->hasOne('App\Models\CategoriaVariable', 'categoria_padre_id');
	}

	public function variables()
	{
		return $this->hasMany('App\Models\Variable', 'categoria_id');
	}
}
