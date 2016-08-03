<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
	protected $table = 'publicaciones';
	protected $fillable = ['nombre', 'descripcion', 'archivo', 'palabras_clave', 'anio_publicacion', 'orden', 'categoria_id'];

    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria', 'categoria_id');
    }

    public function get_file_path()
    {
    	return $this->categoria->get_path().'/'.$this->archivo;
    }

    public function delete()
	{
		parent::delete();
		\File::delete($this->get_file_path());
	}


}