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
function ver_pdf($fullpath,$url)
{
    archivos($fullpath,$url,"inline");
}
function descargar_pdf($fullpath, $url)
{
    archivos($fullpath,$url,"attachment");
}
function archivos($fullpath,$url,$disposition)
{
    if( is_readable($fullpath) )
    {
        $fd = fopen($fullpath, "rb");
        if ($fd) {
            $fsize = filesize($fullpath);
            $path_parts = pathinfo($fullpath);
            $ext = strtolower($path_parts["extension"]);
            switch ($ext) {
                case "pdf":
                header("Content-type: application/pdf");
                break;
                case "zip":
                header("Content-type: application/zip");
                break;
                default:
                header("Content-type: application/octet-stream");
                break;
            }
            header("Content-Disposition: ".$disposition."; filename=\"".$path_parts["basename"]."\"");
            header("Content-length: $fsize");
            header("Cache-control: private"); //use this to open files directly
            while(!feof($fd)) {
                $buffer = fread($fd, 1*(1024*1024));
                echo $buffer;
                ob_flush();
                flush();    //These two flush commands seem to have helped with performance
            }
        }
        else {
            echo "Error opening file";
        }
        fclose($fd);
    }
    else
    {
        \Session::flash('error', 'El archivo al que quiere acceder no existe.');
        return redirect($url);
    }
}
function csv_to_array($filename='', $delimiter=';')
{
    if(!file_exists($filename) || !is_readable($filename))
        return FALSE;
 
    $result = array();
    if (($handle = fopen($filename, "r")) !== FALSE) {
        $header = "";
        while (($data = fgetcsv($handle,1000, $delimiter)) !== FALSE) {
            if( $data[0] != ""){
                $result[$data[0]] = array();
                $header = $data[0];
            }
            if($header == "#Datos"){
                $result[$header][] = [ 'variable_id' => $data[1], 'zona_id' => $data[2], 'unidad_medida_id' => $data[3], 'fuente_id' => $data[4], 'frecuencia_id' => $data[5], 'anio' => $data[6], 'valor' => (float)str_replace(',', '.', $data[7])];
            }else{
                if(($header == "#Variables")&&(isset($data[3]))&&($data[3] != "")){
                    $result[$header][] = [ 'codigo' => $data[1], 'nombre' => $data[2], 'tema' => $data[3]];
                }else{
                    $result[$header][] = [ 'codigo' => $data[1], 'nombre' => $data[2]];
                }
            }
        }
        fclose($handle);
    }
    return $result;
}

function txt_to_array($filename='')
{
    if(!file_exists($filename) || !is_readable($filename))
        return FALSE;
 
    $result = array();
    $header = "";
    
    $lines = file($filename, FILE_IGNORE_NEW_LINES);
    foreach ($lines as $line) {
        $encoded_line = iconv(mb_detect_encoding($line, mb_detect_order(), true), "UTF-8", $line);
        $data = explode("\t", $encoded_line);
        if( $data[0] != ""){
            $result[$data[0]] = array();
            $header = $data[0];
        }
        if($header == "#Datos"){
            $result[$header][] = [ 'variable_id' => $data[1], 'zona_id' => $data[2], 'unidad_medida_id' => $data[3], 'fuente_id' => $data[4], 'frecuencia_id' => $data[5], 'anio' => $data[6], 'valor' => (float)str_replace(',', '.', $data[7])];
        }else{
            if(($header == "#Variables")&&(isset($data[3]))&&($data[3] != "")){
                $result[$header][] = [ 'codigo' => $data[1], 'nombre' => $data[2], 'tema' => $data[3]];
            }else{
                $result[$header][] = [ 'codigo' => $data[1], 'nombre' => $data[2]];
            }
        }
    }
    
    return $result;
}

function boolean_html($boolean)
{
    if($boolean){
        $simbol = 'ok';
    }else{
        $simbol = 'remove';
    }
    return "<span class='glyphicon glyphicon-{$simbol}' aria-hidden='true'></span>";
}
function get_anios($datos = null)
{
    $lista = $datos ? $datos : array();
    for($i = 2015; $i <= date('Y'); $i++)
    {   
        $lista[$i] = $i;
    }
    return $lista;
}
?>