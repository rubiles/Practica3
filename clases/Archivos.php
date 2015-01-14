<?php


class Archivos {
    
 static function eliminarDir($carpeta){   
    foreach(glob($carpeta . "/*") as $archivos_carpeta)
    {
        echo $archivos_carpeta;
        if (is_dir($archivos_carpeta))
        {
            eliminarDir($archivos_carpeta);
        }
        else
        {
            unlink($archivos_carpeta);
        }
    }
    if(file_exists($carpeta))
        rmdir($carpeta);   
    }

    
static function eliminarDir2($carpeta){
  while ($archivo = readdir($carpeta)){
      echo "$archivo<br>"; 
      unlink($archivo);
  }
  unlink($carpeta);
closedir($carpeta); 
}

static function verDirectorio($id){
    $ruta=Configuracion::IMAGE_FOLDER.$id;
    $array_arcvhivos=array();
      if(file_exists($ruta)){
        $directorio=opendir($ruta); 
        echo "<b>Directorio actual:</b><br>$ruta<br>"; 
        echo "<b>Archivos:</b><br>"; 
            while ($archivo = readdir($directorio)){
                if($archivo!="." && $archivo!="..")
                {
                    $array_archivos[]=$archivo;
                }
        }    
}
closedir($directorio); 
return $array_archivos;
}

static function devuelvePrimerFichero($id){
     $ruta=Configuracion::IMAGE_FOLDER.$id;
    $array_arcvhivos=array();
      if(file_exists($ruta)){
        $directorio=opendir($ruta); 
            while ($archivo = readdir($directorio)){
                if($archivo!="." && $archivo!="..")
                {
                    return $archivo;
                }
        } 
    }
 return -1;
}

static function devuelvePorNombre($nombre){
    $ruta="../image/";
     if(file_exists($ruta)){
        $directorio=opendir($ruta); 
            while ($archivo = readdir($directorio)){
                //echo stripos($archivo, $nombre)."<br/>";
                if(stripos($archivo, $nombre)===0)
                {
                    return $archivo;
                }
        } 
    }
 return -1;
}
}
?>
