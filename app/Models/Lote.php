<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
  	const ESTADO_PENDIENTE = 0;
  	const ESTADO_PROCESANDO = 1;
  	const ESTADO_ERROR = 2;
  	const ESTADO_FINALIZADO = 3;
  	
  	protected $fillable = ['archivo', 'estado', 'error', 'usuario_id'];

  	protected $estados = [
  		0 => 'Pendiente',
  		1 => 'En proceso',
  		2 => 'Error',
  		3 => 'Finalizado'
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

	public function categorias()
	{
		return $this->hasMany('App\Models\CategoriaVariable');
	} 
	public function variables()
	{
		return $this->hasMany('App\Models\Variable');
	}  
	public function fuentes()
	{
		return $this->hasMany('App\Models\Fuente');
	}
	public function unidades()
	{
		return $this->hasMany('App\Models\UnidadMedida');
	}
	public function zonas()
	{
		return $this->hasMany('App\Models\ZonaGeografica');
	}
	public function datos()
	{
		return $this->hasMany('App\Models\InformacionVariable');
	}
}
