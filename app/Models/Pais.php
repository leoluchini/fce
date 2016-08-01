<?php

namespace App\Models;

use App\Models\ZonaGeografica;

class Pais extends ZonaGeografica
{
	protected static $singleTableType = 'pais';

    public function provincias()
    {
        return $this->hasMany('App\Models\Provincia');
    }
}
