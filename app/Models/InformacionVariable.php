<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Variable;
use App\Models\UnidadMedida;
use App\Models\Frecuencia;
use App\Models\Fuente;
use App\Models\Zona;
use App\Models\InformacionAdicional;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class InformacionVariable extends Model
{
    protected $table = 'informacion_variables';
	protected $fillable = ['anio', 'valor'];
	protected $primaryKey = 'id';

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
		return $this->hasOne('App\Models\Zona', 'id', 'zona_id');
	}

	public function informacion_adicional()
	{
		return $this->belongsToMany('App\Models\InformacionAdicional', 'informacion_adicional_variables', 'informacion_variable_id', 'informacion_adicional_id');
	}
}
