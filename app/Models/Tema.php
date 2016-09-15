<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
	protected $table = 'temas';
	protected $fillable = ['codigo', 'nombre'];

  	public static function firstOrCreate(array $attributes)
	{
		if ( ! is_null($instance = self::where('codigo',$attributes['codigo'])->first()))
		{
			return $instance;
		}
		return self::create($attributes);
	}

	public function variables()
	{
		return $this->hasMany('App\Models\Variable', 'tema_id', 'id');
	}
}
