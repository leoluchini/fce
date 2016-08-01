<?php

namespace App\Models;

use ZonaGeografica;

class Pais extends ZonaGeografica
{
    public function provincias()
    {
        return $this->hasMany('App\Models\Provincia');
    }
}
