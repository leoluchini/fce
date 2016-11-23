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
}