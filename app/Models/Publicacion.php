<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
	protected $table = 'publicaciones';
	protected $fillable = ['codigo', 'nombre', 'descripcion', 'path', 'palabras_clave', 'anio_publicacion', 'orden'];

    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria', 'categoria_id');
    }
}