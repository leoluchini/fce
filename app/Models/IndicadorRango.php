<?php

namespace App\Models;

use AsociacionRango;

class IndicadorRango extends AsociacionRango
{
    public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery($excludeDeleted)->where('tipo', '=', static::indicadorRango);
    }
}
