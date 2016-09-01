<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fuente extends Model
{
    protected $table = 'fuentes';
		
		protected $fillable = ['codigo', 'nombre', 'descripcion', 'lote_id'];


	  public static function firstOrCreate(array $attributes)
		{
			if ( ! is_null($instance = self::where('codigo',$attributes['codigo'])->first()))
			{
				return $instance;
			}
			return self::create($attributes);
		}
}
