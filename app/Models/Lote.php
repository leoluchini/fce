<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
  
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
