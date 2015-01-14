<?php

class Validar {

    static function isCorreo($v){
         return filter_var($v, FILTER_VALIDATE_EMAIL);
         
         /*
          * ESTE FILTER_VAR ME DUVUELVE UN BOLEANO 
          */
           
    }
    
    static function isEntero($v){
         if(filter_var($v, FILTER_VALIDATE_INT))
                return true;
        return false;
    }
    
    static function isNumero($v){
         if(filter_var($v, FILTER_VALIDATE_FLOAT) || filter_var($v, FILTER_VALIDATE_INT))
                return true;
        return false;
    }
    
    static function isURL($v){
         if(filter_var($v, FILTER_VALIDATE_URL))
                return true;
        return false;
    }
    
    static function isIP($v){
         if(filter_var($v, FILTER_VALIDATE_IP))
                return true;
        return false;
    }
    
    static function isTelefono($v){
        //  DEBERES ->EXPRESIONES REGULARES
    }
    
    static function isFecha($v){
        // DEBERES ->EXPRESIONES REGULARES
    }
    
    static function isDNI($v){
        
    }
    
    static function isCP($v){
        /*
         * CON EXPRESION REGULAR
         * PP->01 / 53
         * 1-9 SI NO ES CAPITAL DE PROVINCIA
         * 01,99 DISTRITO, LOCALIDAD,MUNICIPIO
         * 
         */
    }
    
    static function isLongitudMinima($v, $l=1){
        if(strlen(trim($v))>$min)
            return true;
       return false;
    }
    
    static function isLongitud($v, $min=1, $max=250){
        if(strlen(trim($v))>$min && strlen(trim($v))<$max)
            return true;
       return false;
    }
    
    static function isScript($v){
        
    }
    
    static function isUsuario($v){
        //si cumple las condiciones necesarias para ser un nombre de usuario (M,m,num etc)
        $condicion= ("/^[A-Za-z][A-Za-z0-9][5,9]$/");
        //1º empieza con /
        //2º acaba con /
        // empezar por ... -> ^...
        // acabar por  ...$  ->  ...$
        // [Z-Z] UN CARACTER DEL CONJUNTO
        //{N,M}  DE N A M VECES
        
        return self::isCondicion($v, $condicion);
    }
    
    static function isClave($v){
        //si cumple las condiciones necesarias para aceptarla como contraseña
          $expresion_regular= ("/[A-Za-z0-9][6,10]$/");
          return self::isCondicion($v, $expresion_regular);
    }
    
    static function isCondicion($v, $condicion){
        
    }
    
    
    /*
     * $search = array("<",">","&","'", "/");
     * $replace= array("$lt", "&gt", "&amp", "&apos", "&quot");
     * $final=str_replace($search, $replace, $cadena)
     * 
     * ES LO MISMO QUE HACER UN HTMLSPECIALCHARS()
     * ej_
     *      $cadena="< script > ' hola & '";
     *      $final="$lt script $gt &apos hola $amp $apos";
     * 
     * 
     */
    
    
    static function isAltaUsuario($login, $clave, $claveConfirmada, $nombre, $apellido, $email){
        return self::isUsuario($login) &&  self::isCorreo($email) && self::isClave($clave) && ($clave==$claveConfirmada) && self::isLongitud($nombre, 3, 30) && self::isLongitud($apellido, 3, 50);
        //si se cumplen todas las condiciones es true, si no false
    }
    
    
}

?>
