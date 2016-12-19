<?php

namespace App\Models;

use App\Models\ZonaGeografica;

class Provincia extends ZonaGeografica
{
    protected static $singleTableType = 'provincia';

    public function pais()
    {
        return $this->belongsTo('App\Models\Pais', 'zona_padre_id', 'id');
    }

    public function municipios()
    {
        return $this->hasMany('App\Models\Municipio', 'zona_padre_id')->orderBy('id', 'ASC');
    }

    public function tieneHijos()
    {
    	return (count($this->municipios->toArray()) > 0);
    }

    public function hijos()
    {
    	return $this->municipios();
    }

    public function fullName()
    {
        return $this->nombre.' ('.$this->pais->nombre.')';
    }
}
