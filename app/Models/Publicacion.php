<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria', 'categoria_id');
    }
}
