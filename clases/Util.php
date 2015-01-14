<?php


class Util {
  /*  
    private static function getEnlace($p, $paginas, $url){
        if($p<0)
            return "";
        if($p>$paginas)
            return "";
        
        $paginaUsuario=$p+1;
        return "<a href='$url p'>$paginaUsuario</a>";
    }
    
    
    static function getEnlacesPaginacion($p=0, $pag=1, $regporpag,  $url =""){
        $enlaces=array();
        //mirar q me llega en el enlace
        if(strpos($url , "?") == false)
            $url .="?";
        else
             $url .="&";
        
        //en caso general
        $enlaces['inicio']="<a class='paginacion' href='$url p=o'>&laquo;</a>";
        $enlaces['ultimo']="<a class='paginacion' href='$url p=".($pag)."'>&raquo;</a>";
        
        //*en caso del primero
        if($p==0)
        {
         //$enlaces["primero"]=self::getEnlace(1, $paginas, $url);
         
             $enlaces['anterior']="<a class='paginacion'   href='#'>&lt;</a>";
             $enlaces['siguiente']="<a class='paginacion' href='$url p=1'>&gt;</a>";
             $enlaces['primero']="<a class='paginacion'  id='pag_actual' href='#'>1</a>";
             $enlaces['segundo']="<a class='paginacion' href='$url p=1'>2</a>";
             $enlaces['actual']="<a class='paginacion' href='$url p=2'>3</a>";
             $enlaces['cuarto']="<a class='paginacion' href='$url p=3'>4</a>";
             $enlaces['quinto']="<a class='paginacion' href='$url p=4'>5</a>";
        }
        else if($p==1){
             $enlaces['anterior']="<a class='paginacion' href='$url p=0'>&lt;</a>";
             $enlaces['siguiente']="<a class='paginacion' href='$url p=2'>&gt;</a>";
             $enlaces['primero']="<a class='paginacion' href='$url p=0'>1</a>";
             $enlaces['segundo']="<a class='paginacion' id='pag_actual' href='#'>2</a>";
             $enlaces['actual']="<a class='paginacion' href='$url p=2'>3</a>";
             $enlaces['cuarto']="<a class='paginacion' href='$url p=3'>4</a>";
             $enlaces['quinto']="<a class='paginacion' href='$url p=4'>5</a>";   
        }
        
        
      //*ULTIMO
        else if($p==($pag)){
             $enlaces['anterior']="<a class='paginacion' href='$url p=".($p-1)."'>&lt;</a>";
             $enlaces['siguiente']="<a class='paginacion' href='#'>&gt;</a>";
             
             $enlaces['primero']="<a class='paginacion' href='$url p=".($p-4)."'>".($p-3)."</a>";
             $enlaces['segundo']="<a class='paginacion' href='$url p=".($p-3)."'>".($p-2)."</a>";
             $enlaces['actual']="<a class='paginacion' href='$url p=".($p-2)."'>".($p-1)."</a>";
             $enlaces['cuarto']="<a class='paginacion'    href='$url p=".($p-1)."'>".($p)."</a>";
             $enlaces['quinto']="<a class='paginacion' id='pag_actual' href='#'>".($p+1)."</a>";   
        }
        
       //PENULTIMO
        else if($p==($pag-1)){
             $enlaces['anterior']="<a class='paginacion' href='$url p=".($p-1)."'>&lt;</a>";
             $enlaces['siguiente']="<a class='paginacion'  href='$url p=".($p+1)."'>&gt;</a>";
             
             $enlaces['primero']="<a class='paginacion' href='$url p=".($p-4)."'>".($p-2)."</a>";
             $enlaces['segundo']="<a class='paginacion' href='$url p=".($p-3)."'>".($p-1)."</a>";
             $enlaces['actual']="<a class='paginacion' href='$url p=".($p-2)."'>".($p)."</a>";
             $enlaces['cuarto']="<a class='paginacion'  id='pag_actual'   href='#'>".($p+1)."</a>";
             $enlaces['quinto']="<a class='paginacion'  href='$url p=$p'>".($p+2)."</a>";   
      }
        else if($p<$pag){
  
  //*MODIFICAR ENLACES Y DEJARLOS COMO ARRIBA CON LO S   ."($P-X)."                     
            $enlaces['anterior']="<a class='paginacion' href='$url p=".($p-1)."'>&lt;</a>";
             $enlaces['siguiente']="<a class='paginacion' href='$url p=".($p+1)."'>&gt;</a>";
             $enlaces['primero']="<a class='paginacion' href='$url p=".($p-2)."'>".($p-1)."</a>";
             $enlaces['segundo']="<a class='paginacion' href='$url p=".($p-1)."'>".($p)."</a>";
             $enlaces['actual']="<a class='paginacion' id='pag_actual'  href='#'>".($p+1)."</a>";
             $enlaces['cuarto']="<a class='paginacion' href='$url p=".($p+1)."'>".($p+2)."</a>";
             $enlaces['quinto']="<a class='paginacion' href='$url p=".($p+2)."'>".($p+3)."</a>";   
        }
        
        //*en caso del segundo
        
        //*en caso del penultimo
        
        //*en caso del ultimo
        
       return $enlaces; 
    }

*/
    
    private static function getEnlace($pagina, $paginas, $url){
        if($pagina<0)
            return "";
        if($pagina>$paginas)
            return "";
        $paginaUsuario = $pagina+1;
        return "<a href='".$url."pagina=$pagina'>$paginaUsuario</a>";
    }
    
     public static function getEnlacesPaginacion($pagina, $nr, $nrpp, $url = "") {
        $pos = strpos($url, "?");
        if($pos===false){
            $url .= "?";
        } else {
            $url .= "&";
        }
        $paginas = ceil($nr / $nrpp) - 1;
        if ($pagina < 0) {
            $pagina = 0;
        }
        $ant = $pagina - 1;
        if ($ant < 0) {
            $ant = 0;
        }
        $sig = $pagina + 1;
        if ($sig >= $paginas) {
            $sig = $paginas;
        }
        if ($pagina > $paginas) {
            $pagina = $paginas;
        }
        $resultado["inicio"] = "<a href='".$url."pagina=0'>&lt;&lt;</a>";
        $resultado["anterior"] = "<a href='".$url."pagina=$ant'>&lt;</a>";
        $resultado["siguiente"] = "<a href='".$url."pagina=$sig'>&gt;</a>";
        $resultado["ultimo"] = "<a href='".$url."pagina=$paginas'>&gt;&gt;</a>";
        if($pagina==0){
            $resultado["primero"] = $pagina+1;
            $resultado["segundo"] = self::getEnlace(1, $paginas, $url);
            $resultado["actual"] = self::getEnlace(2, $paginas, $url);
            $resultado["cuarto"] = self::getEnlace(3, $paginas, $url);;
            $resultado["quinto"] = self::getEnlace(4, $paginas, $url);;
        } elseif($pagina==1){
            $resultado["primero"] = self::getEnlace(0, $paginas, $url);
            $resultado["segundo"] = $pagina+1;
            $resultado["actual"] = self::getEnlace(2, $paginas, $url);
            $resultado["cuarto"] = self::getEnlace(3, $paginas, $url);
            $resultado["quinto"] = self::getEnlace(4, $paginas, $url);
        } elseif($pagina==$paginas){
            $resultado["primero"] = self::getEnlace($pagina-4, $paginas, $url);
            $resultado["segundo"] = self::getEnlace($pagina-3, $paginas, $url);
            $resultado["actual"] = self::getEnlace($pagina-2, $paginas, $url);
            $resultado["cuarto"] = self::getEnlace($pagina-1, $paginas, $url);
            $resultado["quinto"] = $pagina+1;
        } elseif($pagina+1==$paginas){
            $resultado["primero"] = self::getEnlace($pagina-3, $paginas, $url);
            $resultado["segundo"] = self::getEnlace($pagina-2, $paginas, $url);
            $resultado["actual"] = self::getEnlace($pagina-1, $paginas, $url);
            $resultado["cuarto"] = $pagina+1;
            $resultado["quinto"] = self::getEnlace($pagina+1, $paginas, $url);
        } else {
            $resultado["primero"] = self::getEnlace($pagina-2, $paginas, $url);
            $resultado["segundo"] = self::getEnlace($pagina-1, $paginas, $url);
            $resultado["actual"] = $pagina+1;
            $resultado["cuarto"] = self::getEnlace($pagina+1, $paginas, $url);
            $resultado["quinto"] = self::getEnlace($pagina+2, $paginas, $url);
        }
        return $resultado;
    }

     private static function getEnlaceJSON($pagina, $paginas){
        if($pagina<0)
            return -1;
        if($pagina>$paginas)
            return -1;
        return $pagina;
    }
    
    
    public static function getEnlacesPaginacionJSON($pagina, $nr, $nrpp, $url = "") {
        $paginas = ceil($nr / $nrpp) - 1;
        if ($pagina < 0) {
            $pagina = 0;
        }
        if ($pagina > $paginas) {
            $pagina = $paginas;
        }
        $ant = $pagina - 1;
        if ($ant < 0) {
            $ant = 0;
        }
        $sig = $pagina + 1;
        if ($sig >= $paginas) {
            $sig = $paginas;
        }
        $resultado["inicio"] = 0;
        $resultado["anterior"] = $ant;
        $resultado["siguiente"] = $sig;
        $resultado["ultimo"] = $paginas;
        if($pagina==0){
            $resultado["primero"] = $pagina+1;
            $resultado["segundo"] = self::getEnlaceJSON(1, $paginas);
            $resultado["actual"] = self::getEnlaceJSON(2, $paginas);
            $resultado["cuarto"] = self::getEnlaceJSON(3, $paginas);;
            $resultado["quinto"] = self::getEnlaceJSON(4, $paginas);;
        } elseif($pagina==1){
            $resultado["primero"] = self::getEnlaceJSON(0, $paginas);
            $resultado["segundo"] = $pagina+1;
            $resultado["actual"] = self::getEnlaceJSON(2, $paginas);
            $resultado["cuarto"] = self::getEnlaceJSON(3, $paginas);
            $resultado["quinto"] = self::getEnlaceJSON(4, $paginas);
        } elseif($pagina==$paginas){
            $resultado["primero"] = self::getEnlaceJSON($pagina-4, $paginas);
            $resultado["segundo"] = self::getEnlaceJSON($pagina-3, $paginas);
            $resultado["actual"] = self::getEnlaceJSON($pagina-2, $paginas);
            $resultado["cuarto"] = self::getEnlaceJSON($pagina-1, $paginas);
            $resultado["quinto"] = $pagina+1;
        } elseif($pagina+1==$paginas){
            $resultado["primero"] = self::getEnlaceJSON($pagina-3, $paginas);
            $resultado["segundo"] = self::getEnlaceJSON($pagina-2, $paginas);
            $resultado["actual"] = self::getEnlaceJSON($pagina-1, $paginas);
            $resultado["cuarto"] = $pagina+1;
            $resultado["quinto"] = self::getEnlaceJSON($pagina+1, $paginas);
        } else {
            $resultado["primero"] = self::getEnlaceJSON($pagina-2, $paginas);
            $resultado["segundo"] = self::getEnlaceJSON($pagina-1, $paginas);
            $resultado["actual"] = $pagina+1;
            $resultado["cuarto"] = self::getEnlaceJSON($pagina+1, $paginas);
            $resultado["quinto"] = self::getEnlaceJSON($pagina+2, $paginas);
        }
        return $resultado;
    }

    public static function getPaginacionJSON($pagina, $nr, $nrpp, $url = "") {
        $paginas = ceil($nr / $nrpp) - 1;
        if ($pagina < 0) {
            $pagina = 0;
        }
        if ($pagina > $paginas) {
            $pagina = $paginas;
        }
        $ant = $pagina - 1;
        if ($ant < 0) {
            $ant = 0;
        }
        $sig = $pagina + 1;
        if ($sig >= $paginas) {
            $sig = $paginas;
        }
        $resultado[] = 0;
        $resultado[] = $ant;
        $resultado[] = $sig;
        $resultado[] = $paginas;
        if($pagina==0){
            $resultado[] = $pagina+1;
            $resultado[] = self::getEnlaceJSON(1, $paginas);
            $resultado[] = self::getEnlaceJSON(2, $paginas);
            $resultado[] = self::getEnlaceJSON(3, $paginas);;
            $resultado[] = self::getEnlaceJSON(4, $paginas);;
        } elseif($pagina==1){
            $resultado[] = self::getEnlaceJSON(0, $paginas);
            $resultado[] = $pagina+1;
            $resultado[] = self::getEnlaceJSON(2, $paginas);
            $resultado[] = self::getEnlaceJSON(3, $paginas);
            $resultado[] = self::getEnlaceJSON(4, $paginas);
        } elseif($pagina==$paginas){
            $resultado[] = self::getEnlaceJSON($pagina-4, $paginas);
            $resultado[] = self::getEnlaceJSON($pagina-3, $paginas);
            $resultado[] = self::getEnlaceJSON($pagina-2, $paginas);
            $resultado[] = self::getEnlaceJSON($pagina-1, $paginas);
            $resultado[] = $pagina+1;
        } elseif($pagina+1==$paginas){
            $resultado[] = self::getEnlaceJSON($pagina-3, $paginas);
            $resultado[] = self::getEnlaceJSON($pagina-2, $paginas);
            $resultado[] = self::getEnlaceJSON($pagina-1, $paginas);
            $resultado[] = $pagina+1;
            $resultado[] = self::getEnlaceJSON($pagina+1, $paginas);
        } else {
            $resultado[] = self::getEnlaceJSON($pagina-2, $paginas);
            $resultado[] = self::getEnlaceJSON($pagina-1, $paginas);
            $resultado[] = $pagina+1;
            $resultado[] = self::getEnlaceJSON($pagina+1, $paginas);
            $resultado[] = self::getEnlaceJSON($pagina+2, $paginas);
        }
        return $resultado;
    }

}
?>
