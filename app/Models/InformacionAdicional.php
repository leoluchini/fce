<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DatoAdicional;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InformacionAdicional extends Model
{
    protected $table = 'informacion_adicional';
	protected $primaryKey = 'id';

	public function datos()
	{
		return $this->hasMany('App\Models\DatoAdicional', 'informacion_id', 'id');
	}
}
