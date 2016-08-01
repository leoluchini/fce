<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Rango;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AsociacionRango extends Model
{
    protected $table = 'asociacion_rangos';
	protected $fillable = ['orden'];
	protected $primaryKey = 'id';

	public function rangos()
	{
		//return $this->hasOne('Phone', 'foreign_key', 'local_key');
		return $this->hasMany('App\Models\Rango', 'asociacion_id', 'id')->orderBy('valor_inicio', $this->orden);
	}
}
