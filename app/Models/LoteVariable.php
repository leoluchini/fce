<?php

namespace App\Models;

use App\Models\Lote;

class LoteVariable extends Lote
{
	protected static $singleTableType = 'variable';

  public function categorias()
  {
      return $this->hasMany('App\Models\CategoriaVariable', 'lote_id');
  }

  public function variables()
  {
      return $this->hasMany('App\Models\Variable', 'lote_id');
  }
   
	public function datos()
	{
		return $this->hasMany('App\Models\InformacionVariable', 'lote_id');
	}

  public function datosCount()
  {
    return $this->hasOne('App\Models\InformacionVariable', 'lote_id')
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