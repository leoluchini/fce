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
}