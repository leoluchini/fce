<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformacionAdicional extends Model
{
    protected $table = 'informacion_adicional';

	public function datos()
	{
		return $this->hasMany('App\Models\DatoAdicional', 'informacion_id', 'id');
	}
}
