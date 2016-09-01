<?php

use Illuminate\Database\Seeder;
use App\Models\Publicacion;

class PublicacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Publicacion::create(['nombre' => 'Documento social uno', 'descripcion' => 'documento prueba uno', 'archivo'=> 'Doc1.pdf', 'palabras_clave' => 'palabra clave', 'anio_publicacion' => 2015, 'categoria_id' => 1]);
        Publicacion::create(['nombre' => 'Documento social dos', 'descripcion' => 'documento prueba dos', 'archivo'=> 'Doc2.pdf', 'palabras_clave' => 'palabra clave', 'anio_publicacion' => 2015, 'categoria_id' => 1]);
        Publicacion::create(['nombre' => 'Documento produccion uno', 'descripcion' => 'documento prueba uno', 'archivo'=> 'Doc1.pdf', 'palabras_clave' => 'palabra clave', 'anio_publicacion' => 2015, 'categoria_id' => 2]);
        Publicacion::create(['nombre' => 'Documento produccion dos', 'descripcion' => 'documento prueba dos', 'archivo'=> 'Doc2.pdf', 'palabras_clave' => 'palabra clave', 'anio_publicacion' => 2015, 'categoria_id' => 2]);
        Publicacion::create(['nombre' => 'Documento fiscal uno', 'descripcion' => 'documento prueba uno', 'archivo'=> 'Doc1.pdf', 'palabras_clave' => 'palabra clave', 'anio_publicacion' => 2015, 'categoria_id' => 3]);
        Publicacion::create(['nombre' => 'Documento fiscal dos', 'descripcion' => 'documento prueba dos', 'archivo'=> 'Doc2.pdf', 'palabras_clave' => 'palabra clave', 'anio_publicacion' => 2015, 'categoria_id' => 3]);
        Publicacion::create(['nombre' => 'Documento demografico uno', 'descripcion' => 'documento prueba uno', 'archivo'=> 'Doc1.pdf', 'palabras_clave' => 'palabra clave', 'anio_publicacion' => 2015, 'categoria_id' => 4]);
        Publicacion::create(['nombre' => 'Documento demografico dos', 'descripcion' => 'documento prueba dos', 'archivo'=> 'Doc2.pdf', 'palabras_clave' => 'palabra clave', 'anio_publicacion' => 2015, 'categoria_id' => 4]);
    }
}
