<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fuente extends Model
{
    protected $table = 'fuentes';
	protected $fillable = ['sigla', 'nombre', 'descripcion'];
	protected $primaryKey = 'id';
}
