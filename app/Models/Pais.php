<?php

namespace App\Models;

use App\Models\ZonaGeografica;

class Pais extends ZonaGeografica
{
	protected static $singleTableType = 'pais';

    public function provincias()
    {
        return $this->hasMany('App\Models\Provincia','zona_padre_id', 'id')->orderBy('id', 'ASC');
    }

    public function tieneHijos()
    {
    	return (count($this->provincias->toArray()) > 0);
    }

    public function hijos()
    {
    	return $this->provincias();
    }

}
