<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatoAdicional extends Model
{
    protected $table = 'datos_adicionales';
	protected $fillable = ['descripcion'];

}
