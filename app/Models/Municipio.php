<?php

namespace App\Models;

use ZonaGeografica;

class Municipio extends ZonaGeografica
{
    public function provincia()
    {
        return $this->belongsTo('App\Models\Provincia', 'zona_padre_id');
    }
}
