<?php

namespace App\Models;

use App\Models\Lote;

class LoteIndicador extends Lote
{
	protected static $singleTableType = 'indicador';

  public function categorias()
  {
      return $this->hasMany('App\Models\CategoriaIndicador', 'lote_id');
  }

  public function indicadores()
  {
      return $this->hasMany('App\Models\Indicador', 'lote_id');
  } 

  public function datos()
	{
		return $this->hasMany('App\Models\InformacionIndicador', 'lote_id');
	}
  
  public function datosCount()
  {
    return $this->hasOne('App\Models\InformacionIndicador', 'lote_id')
      ->selectRaw('lote_id, count(*) as aggregate')
      ->groupBy('lote_id');
  }
   
  public function getDatosCountAttribute()
  {
    // if relation is not loaded already, let's do it first
    if ( ! array_key_exists('datosCount', $this->relations)) 
      $this->load('datosCount');
   
    $related = $this->getRelation('datosCount');
   
    // then return the count directly
    return ($related) ? (int) $related->aggregate : 0;
  }
}