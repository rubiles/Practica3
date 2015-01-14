<?php

require '../require/comun.php';
$bd = new BaseDatos();

if (!$bd->isConectado()) {
    header("Location: viewAlta.php?operacion=-1");
    exit();
}

$login = Leer::post("login");
$email = Leer::post("correo");


$usuario = new Usuario($login, null, null, null, $email);
$modelo = new ModeloUsuario($bd);
//$r=$modelo->getCorreo($usuario);

if ($login != "") {
    $r = $modelo->getByLogin($login);
    if ($r != null) {
        $id = md5($r->getLogin() . Configuracion::PEZARANA . $r->getEmail()); //mandar un enlace   http://....../phpConfirmar?id=23423re23423423423&login=tulogin  donde esa cadena será
        $url = Entorno::getEnlaceyCarpeta("viewCambiarClave.php?id=$id&login=" . $r->getLogin());
        $enlace = "Pincha aqui: <a href='$url'>Cambiar clave</a>";
        $email = $r->getEmail();
        $r = Correo::enviarGmail(Configuracion::ORIGENGMAIL, $email, Configuracion::CLAVEGMAIL, "Cambiar clave para $login", $enlace);
        //echo "<hr>".$url;
        //echo "<hr>".$enlace;
        //echo "<hr>".$r;
        header("Location: ../index.php?error=7");
    }
    else
        header("Location: ../index.php?error=8");
}
else if ($email != "") {
    $enlace = "";
    $r = $modelo->getCorreo($email);
    if ($r != null) {
        foreach ($r as $indice => $objeto) {
            $id = md5($objeto->getLogin() . Configuracion::PEZARANA . $objeto->getEmail()); //mandar un enlace   http://....../phpConfirmar?id=23423re23423423423&login=tulogin  donde esa cadena será
            $url = Entorno::getEnlaceyCarpeta("viewCambiarClave.php?id=$id&login=" . $objeto->getLogin());
            $enlace.="Pincha aqui: <a href='$url'>Cambiar clave de " . $objeto->getLogin() . "</a><br/>";
            // echo "<hr>".$url;
            // echo "<hr>".$enlace;
            //  echo "<hr>".$objeto->getLogin();   
        }
        $r = Correo::enviarGmail(Configuracion::ORIGENGMAIL, $email, Configuracion::CLAVEGMAIL, "Cambiar clave para su usuario", $enlace);
        header("Location: ../index.php?error=7");
    }
    else
        header("Location: ../index.php?error=9");
}
//ENVIAR CORREO
//   header("Location: viewAlta.php?operacion=correoenviado ");
//  exit();        
// }
?>
