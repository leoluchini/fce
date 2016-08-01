<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsociacionRango extends Model
{
    protected $table = 'asociacion_rangos';
	protected $fillable = ['orden'];

	public function rangos()
	{
		return $this->hasMany('App\Models\Rango', 'asociacion_id')->orderBy('valor_inicio', $this->orden);
	}
}
