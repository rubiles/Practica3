<?php

require '../require/comun.php';
$bd = new BaseDatos();

if (!$bd->isConectado()) {
    header("Location: viewAlta.php?operacion=-1");
    exit();
}

$login = Leer::post("login");
$clave = Leer::post("clave");
$claveConfirmada = Leer::post("clave2");
$nombre = Leer::post("nombre");
$apellido = Leer::post("apellido");
$email = Leer::post("email");

/* if(!Validar::isAltaUsuario($login, $clave, $claveConfirmada, $nombre, $apellido, $email)){
  header("Location: viewAlta.php ");
  exit();
  }
  else{
 */
$usuario = new Usuario($login, $clave, $nombre, $apellido, $email);
$modelo = new ModeloUsuario($bd);
$r = $modelo->add($usuario);

if ($r == 1) {  //en caso de exito le enviamos un correo con un enlace a nuestro sitio web de confirmacion.
    $id = md5($email . Configuracion::PEZARANA . $login); //mandar un enlace   http://....../phpConfirmar?id=23423re23423423423&login=tulogin  donde esa cadena será
    $url = Entorno::getEnlaceyCarpeta("phpConfirmarAlta.php?id=$id&login=$login");
    $enlace = "Pincha aqui: <a href='$url'>Confirmar alta en la página</a>";
    $r = Correo::enviarGmail(Configuracion::ORIGENGMAIL, $email, Configuracion::CLAVEGMAIL, "Alta en la Web para $nombre $apellido", $enlace);
    /*   echo "<hr>".$url;
      echo "<hr>".$enlace;
      echo "<hr>".$r;
     */
//ENVIAR CORREO

    header("Location: ../index.php?error=4&operacion=correoenviado&enlace=$url ");
    exit();
    // }
}
?>
