<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformacionIndicadorDato extends Model
{
    protected $table = 'info_extra_indicadores';
	protected $fillable = ['indicador_id', 'lote_id', 'dato'];

	public function indicador()
	{
		return $this->hasOne('App\Models\Indicadores', 'id', 'indicador_id');
	}
	public function lote()
	{
		return $this->hasOne('App\Models\Lote', 'id', 'lote_id');
	}
}
