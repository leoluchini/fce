<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nanigans\SingleTableInheritance\SingleTableInheritanceTrait;

class ZonaGeografica extends Model
{
    use SingleTableInheritanceTrait;

	protected $table = "zonas_geograficas";

	protected static $singleTableTypeField = 'type';

	protected static $singleTableSubclasses = [Pais::class, Provincia::class, Municipio::class];
}
