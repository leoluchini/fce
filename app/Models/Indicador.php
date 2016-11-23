<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    protected $table = 'indicadores';
	protected $fillable = ['codigo', 'nombre', 'descripcion', 'categoria_id', 'lote_id', 'tema_id'];

	public static function firstOrCreate(array $attributes)
	{
		if ( ! is_null($instance = self::where('codigo',$attributes['codigo'])->first()))
		{
			return $instance;
		}
		$codigo = explode("-", $attributes['codigo']);
		$categoria = CategoriaIndicador::where('codigo',$codigo[0])->first();
		if(isset($attributes['tema'])){
			$datos = explode("_", $attributes['tema']);
			$attr['codigo'] = strtoupper($datos[0]);
			$attr['nombre'] = strtolower($datos[1]);
			$tema = Tema::firstOrCreate($attr);
			$attributes['tema_id'] = $tema->id;
			unset($attributes['tema']);
		}
		return $categoria->indicadores()->create($attributes);
	}

	public function datos()
	{
		return $this->hasMany('App\Models\InformacionIndicador', 'indicador_id');
	}

	public function categoria()
	{
		return $this->belongsTo('App\Models\CategoriaIndicador', 'categoria_id');
	}

	public function tema()
	{
		return $this->hasOne('App\Models\Tema', 'id', 'tema_id');
	}
}
