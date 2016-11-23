<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nanigans\SingleTableInheritance\SingleTableInheritanceTrait;

class Lote extends Model
{
	use SingleTableInheritanceTrait;

	protected $table = "lotes";

	protected static $singleTableTypeField = 'tipo';

	protected static $singleTableSubclasses = [LoteVariable::class, LoteIndicador::class];

  	const ESTADO_PENDIENTE = 0;
  	const ESTADO_PROCESANDO = 1;
  	const ESTADO_ERROR = 2;
  	const ESTADO_FINALIZADO = 3;
  	const ESTADO_ACEPTADO = 4;
  	
  	protected $fillable = ['archivo', 'estado', 'error', 'usuario_id'];

  	protected $estados = [
  		0 => 'Pendiente',
  		1 => 'En proceso',
  		2 => 'Error',
  		3 => 'Finalizado',
  		4 => 'Aceptado',
  	];
    
    public function getArchivoAttribute($value)
    {
        return public_path('storage').'/'.$value;
    }

    public function getEstadoActualAttribute()
    {
        return $this->estados[$this->estado];
    }
    
    public function usuario()
	{
		return $this->hasOne('App\User', 'id', 'usuario_id');
	}
	
	public function fuentes()
	{
		return $this->hasMany('App\Models\Fuente', 'lote_id');
	}
	public function unidades()
	{
		return $this->hasMany('App\Models\UnidadMedida', 'lote_id');
	}
	public function zonas()
	{
		return $this->hasMany('App\Models\ZonaGeografica', 'lote_id');
	}
}
