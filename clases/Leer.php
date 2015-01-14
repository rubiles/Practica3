<?php

/**
* Class Leer
*
* @version 0.9
* @author izv
* @license http://...
* @copyright izv by cv
 * 
 * 
* Esta clase dispone de metodos estaticos que se utilizan para la lectura de 
 * parametros de entrada a traves de GET y POST
*/

class Leer {

//ESTA DOCUMENTACION ME SIRVE PARA EL DESARROLLO EN GRUPO. SI PONEMOS Leer:get sale la siguiente doc.
//Leer::get
 /**
* Trata de leer el parametro de entrada que se pasa como argumento
* @access public
* @param string $param Cadena con el nombre del parametro
* @return string|array|null Devuelve una cadena con el valor del parametro, null si el parametro 
  * no se ha pasado y un array si el parametro es multiple
*/
    
    public static function get($param, $filtrar=true) {
        if (isset($_GET[$param])) {
            $v = $_GET[$param];
            if (is_array($v)) {
                return Leer::leerArray($v);
            } else {
                if($filtrar)
                    return Leer::limpiar($v);
                else
                    return $v;
            }
            /*
              if ($_GET[$param] === "") {
              return "";
              } else {
              return $_GET[$param];
              }
             */
            /*
              if (empty($_GET[$param])) {
              return "";
              } else {
              return $_GET[$param];
              }
             */
        } else {
            return null;
        }
    }

 
    private static function leerArray($param, $filtrar=true) {
        $array = array();
        foreach ($param as $key => $value) {
          if($filtrar)
             $array[] =  Leer::limpiar($value);
           else
                  $array[] =  $value;
        }
        return $array;
    }

    
//La siguiente funcion devuelve 3 valores, true si es array, false si no lo es, y null si no llega
    public static function isArray($param){    
          if (isset($_GET[$param])) 
              return is_array($_GET[$param]);
          else if (isset($_POST[$param])) 
              return is_array($_GET[$param]);
          else
              return NULL;
                  
    }
    
   public static function isArrayv2($param){    
            return is_array(Leer::request($param));      
    }
    
   
    
   public static function post($param, $filtrar=true) {
        if (isset($_POST[$param])) {
            $v= $_POST[$param];
            if (is_array($v)) {
                return Leer::leerArray($v);
            } else {
               if($filtrar)
                    return Leer::limpiar($v);
                else
                    return $v;
            }
        } else {
            return null;
        }
    }

  
   public static function request($param, $filtrar=true) {
        $v = Leer::get($param, $filtrar);
        if ($v == null) {
            $v = Leer::post($param, $filtrar);
        }
       return $v;
    }

   
    
    private static function limpiar($param) {
        return trim(htmlspecialchars($param));
    }

    
    
}
