<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VariableSinResultados extends Model
{
	protected $table = 'variables_sinresultados';
	protected $fillable = ['busqueda'];

  	public static function firstOrCreate($busqueda)
	{
		if ( ! is_null($instance = self::where('busqueda', strtolower($busqueda))->first()))
		{
			return $instance;
		}
		return self::create(['busqueda' => strtolower($busqueda)]);
	}
}
