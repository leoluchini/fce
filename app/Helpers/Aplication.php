<?php
function path_publicaciones()
{
    return public_path().'/uploads/publicaciones/';
}
function save_file($uploadedFile, $path)
{
	$extension = '.'.$uploadedFile->getClientOriginalExtension();
	$resto = -1 * strlen($extension);
    $nombre = quitar_tildes(substr($uploadedFile->getClientOriginalName(), 0, $resto));
	$nombre = str_replace(' ', '_', $nombre);

	$file_path = $path.$nombre.$extension;
    $file_name = quitar_tildes($uploadedFile->getClientOriginalName());
    $file_name = str_replace(' ', '_', $file_name);

	$counter = 1;
	
	while(File::exists($file_path))
	{
		$file_path = $path.$nombre.'_'.$counter.$extension;
		$file_name = $nombre.'_'.$counter.$extension;
		$counter++;
	}
    echo $path.'<br>';
	echo $file_name.'<br>';
    
	$uploadedFile->move($path, $file_name);
	return $file_name;
}
function quitar_tildes($cadena) 
{
    $no_permitidas = array("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
    $permitidas = array("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
    $texto = str_replace($no_permitidas, $permitidas ,$cadena);
    return $texto;
}
?>