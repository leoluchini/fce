<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Frecuencia extends Model
{
    protected $table = 'frecuencias';
	protected $fillable = ['tipo', 'codigo', 'nombre'];
}
