<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
	protected $fillable = ['codigo', 'nombre', 'descripcion'];

	public function publicaciones()
	{
		//return $this->hasMany('App\Models\Publicacion')->orderBy('orden', 'ASC');
		return $this->hasMany('App\Models\Publicacion')->orderBy('id', 'ASC');
	}

	public function get_path()
	{
		return path_publicaciones().$this->codigo.'/';
	}
}
