<?php

namespace App\Models;

use App\Models\ZonaGeografica;

class Municipio extends ZonaGeografica
{
    protected static $singleTableType = 'municipio';

    public function provincia()
    {
        return $this->belongsTo('App\Models\Provincia', 'zona_padre_id');
    }
}
