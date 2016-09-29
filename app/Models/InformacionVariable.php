<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformacionVariable extends Model
{
    protected $table = 'informacion_variables';
	protected $fillable = ['anio', 'valor','variable_id', 'zona_id', 'unidad_medida_id', 'fuente_id', 'frecuencia_id', 'lote_id'];

	public function variable()
	{
		return $this->hasOne('App\Models\Variable', 'id', 'variable_id');
	}
	public function unidad_medida()
	{
		return $this->hasOne('App\Models\UnidadMedida', 'id', 'unidad_medida_id');
	}
	public function frecuencia()
	{
		return $this->hasOne('App\Models\Frecuencia', 'id', 'frecuencia_id');
	}
	public function fuente()
	{
		return $this->hasOne('App\Models\Fuente', 'id', 'fuente_id');
	}
	public function zona()
	{
		return $this->hasOne('App\Models\ZonaGeografica', 'id', 'zona_id');
	}
}
