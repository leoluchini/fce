<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
	protected $fillable = ['codigo', 'nombre'];

  public static function firstOrCreate(array $attributes)
	{
		if ( ! is_null($instance = self::where('codigo',$attributes['codigo'])->first()))
		{
			return $instance;
		}
		return self::create($attributes);
	}
}
