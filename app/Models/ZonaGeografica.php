<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nanigans\SingleTableInheritance\SingleTableInheritanceTrait;

class ZonaGeografica extends Model
{
    use SingleTableInheritanceTrait;

    protected $fillable = ['codigo', 'nombre', 'zona_padre_id'];
	
	protected $table = "zonas_geograficas";

	protected static $singleTableTypeField = 'tipo';

	protected static $singleTableSubclasses = [Pais::class, Provincia::class, Municipio::class];

	public static function firstOrCreate(array $attributes)
	{
		if ( ! is_null($instance = self::where('codigo',$attributes['codigo'])->first()))
		{
			return $instance;
		}
		$codigo = self::getCodigoSections($attributes['codigo']);
		switch ($codigo) {
			case $codigo[1].$codigo[2] == "00000":
				return Pais::create($attributes);
				break;
			case $codigo[1] != "00" && $codigo[2] == "000":
				$pais = Pais::where('codigo', $codigo[0]."00000")->first();
				return $pais->provincias()->create($attributes);
				break;
			
			default:
				$provincia = Provincia::where('codigo', $codigo[0].$codigo[1]."000")->first();
				return $provincia->municipios()->create($attributes);
				break;
		}
	}

	public static function getCodigoSections($codigo){
		$pais = substr($codigo, 0, 2);
		$provincia = substr($codigo, 2, 2);
		$municipio = substr($codigo, 4, 3);
		return [$pais,$provincia,$municipio];
	}
}
