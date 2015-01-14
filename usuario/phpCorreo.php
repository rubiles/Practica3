<?php

require '../require/comun.php';



$origen = Leer::post("origen");
$destino = Leer::post("destino");
$clave = Leer::post("clave");
$asunto = Leer::post("asunto");
$mensaje = Leer::post("mensaje");

$r = Correo::enviarGmail(Configuracion::ORIGENGMAIL, $email, Configuracion::CLAVEGMAIL, "Alta en la Web", $mensaje);
echo "resultado; " . $r;
?>
