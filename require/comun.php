<?php

$path="../";

// AUTOCARGADOR DE TODAS LAS CLASES DE LA CARPETA CLASES, CADA VEZ QUE SE ENCUENTRA CUALQUIER OBJETO O METODO DE CLASES Q DESCONOCE
          function autoload($clase){                  //el parametro q le llega es la clase que desconoce
               if(file_exists("../clases/".$clase.".php"))
                    require "../clases/".$clase.".php";
               else
                    require "./clases/".$clase.".php";
            }
            spl_autoload_register("autoload");       //se autoejecutara cada vez q encuentra una clase q desconoce
            
$sesion=SesionSingleton::getSesion();

  error_reporting(E_ALL);
  ini_set("display_errors",1);
?>

