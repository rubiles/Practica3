<?php

class Entorno {
    /*       HTTP_HOST: localhost:8008
              SERVER_PORT: 8008
              SERVER_NAME: localhost
              REMOTE_ADDR: 127.0.0.1
              DOCUMENT_ROOT: C:/Apache2.2/htdocs
              SCRIPT_FILENAME: C:/Apache2.2/htdocs/Tema2/php2/variables_server_environment.php
              SCRIPT_NAME: /Tema2/php2/variables_server_environment.php
              REQUEST_METHOD: GET
              QUERY_STRING: id=1, nombre=2
    */
    private function __construct() {
        ;
    }
    
    
    public static function getServidor(){
        return $_SERVER["SERVER_NAME"];
    }
    
        
    public static function getPuerto(){
        return $_SERVER["SERVER_PORT"];
    }
    
        
    public static function getRaiz(){
        return $_SERVER["DOCUMENT_ROOT"];
    }
    
    public static function getMetodo(){
        return $_SERVER["REQUEST_METHOD"];
    }
    
    public static function getParametros(){
        return $_SERVER["QUERY_STRING"];
    }
    
    public static function getScript(){
        return $_SERVER["SCRIPT_NAME"];
    }
    
      public static function getPagina(){
        $script=self::getScript();
       
        $pos =strrpos($script, '/');
        $pagina = substr($script, $pos+1);
        
     return $pagina;
    }
    
    public static function getCarpetaServidor(){
         $script=self::getScript();
       
        $pos =strrpos($script, '/');
        $carpeta = substr($script, 0, $pos+1);
        
     return $carpeta;
     }
     
     
    public static function getPadreRaiz(){
         $carpeta=self::getRaiz();
       
        $pos =strrpos($carpeta, '/');
        $padre = substr($carpeta, 0, $pos+1);
        
     return $padre;
     }
     
     static function getArrayParametros(){
         $array=array();
         $parametros=self::getParametros();
         $partes=  explode("&",$parametros);
         foreach ($partes as $indices =>$valor) {
             $subpartes=  explode("=", $valor);
             
             if(!isset($subpartes[1]))  //evito errores si faltan parametros o parte de los mismos
                 $subpartes[1]="";
             
             if(isset($array[$subpartes[0]])) {  //en caso de q aya mas d un mismo parametro con el mismo nombre
                 if(is_array ($array[$subpartes[0]]))       //si ya hemos pasado  x aqui y ya lo convertimos a array antes
                     $array[$subpartes[0]][]=$subpartes[1];
                 else{
                     $subArray=array();
                     $subArray[]=$array[$subpartes[0]];
                     $subArray[]=$subpartes[1];
                     $array[$subpartes[0]]=$subArray;
                     }
                 
             }
             else
                 $array[$subpartes[0]]=$subpartes[1];
         }
         
         return $array;
     }
     
     static function getEnlaceyCarpeta($pagina=""){
         return "http://".self::getServidor().":".self::getPuerto().self::getCarpetaServidor().$pagina;
     }
    
     
     
      static function getNavegadorCliente(){
        return $_SERVER["HTTP_USER_AGENT"];
   }
    
    static function getIpCliente(){
        return $_SERVER["REMOTE_ADDR"];
    }
}

?>
