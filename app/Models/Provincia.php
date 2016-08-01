<?php

namespace App\Models;

use ZonaGeografica;

class Provincia extends ZonaGeografica
{
    
    public function pais()
    {
        return $this->belongsTo('App\Models\Pais', 'zona_padre_id');
    }

    public function municipios()
    {
        return $this->hasMany('App\Models\Municipio');
    }
}
