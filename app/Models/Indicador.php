<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\IndicadorRango;
use App\Models\InformacionIndicador;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Indicador extends Model
{
    protected $table = 'indicadores';
	protected $fillable = ['codigo', 'nombre', 'descripcion'];
	protected $primaryKey = 'id';

	public function asociacion_rango()
	{
		return $this->hasOne('App\Models\IndicadorRango', 'id', 'item_id');
	}

	public function datos()
	{
		return $this->hasMany('App\Models\InformacionIndicador', 'indicador_id', 'id');
	}
}
