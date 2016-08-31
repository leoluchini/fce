<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
	protected $table = 'variables';
	protected $fillable = ['codigo', 'nombre', 'descripcion', 'categoria_id'];

  public static function firstOrCreate(array $attributes)
	{
		if ( ! is_null($instance = self::where('codigo',$attributes['codigo'])->first()))
		{
			return $instance;
		}
		$codigo = explode("_", $attributes['codigo']);
		$categoria = CategoriaVariable::where('codigo',$codigo[0])->first();
		return $categoria->variables()->create($attributes);


	public function asociacion_rango()
	{
		return $this->hasOne('App\Models\AsociacionRango', 'asociacion_rango_id');
	}

	public function datos()
	{
		return $this->hasMany('App\Models\InformacionVariable', 'variable_id');
	}

	public function categoria()
	{
		return $this->belongsTo('App\Models\CategoriaVariable', 'categoria_id');
	}
}
