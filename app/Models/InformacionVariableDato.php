<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformacionVariableDato extends Model
{
    protected $table = 'info_extra_variables';
	protected $fillable = ['variable_id', 'lote_id', 'dato'];

	public function variable()
	{
		return $this->hasOne('App\Models\Variable', 'id', 'variable_id');
	}
	public function lote()
	{
		return $this->hasOne('App\Models\LoteVariable', 'id', 'lote_id');
	}
}
