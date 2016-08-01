<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Publicacion;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    protected $table = 'categorias';
	protected $fillable = ['codigo', 'nombre', 'descripcion'];
	protected $primaryKey = 'id';

	public function publicaciones()
	{
		return $this->hasMany('App\Models\Publicacion')->orderBy('orden', 'ASC');
	}

}
