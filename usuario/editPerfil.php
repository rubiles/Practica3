<?php

require '../require/comun.php';
$sesion->autentificado("../index.php?error=2");
$usuario = $sesion->getUsuario();


$login = Leer::post("login");
$clave = Leer::post("clave");
$claven1 = Leer::post("claven1");
$claven2 = Leer::post("claven2");
$nombre = Leer::post("nombre");
$apellido = Leer::post("apellido");
$email = Leer::post("email");

//$hay_file=  Leer::post("imagen");
$file = new Subir("imagen");
$file->addExtension("jpg");
$file->addExtension("jpeg");
$file->addExtension("png");
$file->addExtension("gif");
$file->addTipo("images/*");
$file->setMaximo(10 * 1024 * 1024);
$file->setDestino("../image/");
$file->setNombre($login);
$file->setAccion(Subir::REEMPLAZAR);

$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$usuarioModif = new Usuario($login, $claven1, $nombre, $apellido, $email);


$cambioDeClave = strlen($claven1) > 0 && $claven1 = $claven2;
$cambioCorreo = $email != $usuario->getEmail();

if ($cambioDeClave) {
    $claveOld = $modelo->getByLogin($login)->getClave();
    echo $claveOld;
    if (sha1($clave) == $claveOld) {
        if ($claven1 === $claven2)
            $r = $modelo->editConClave($usuarioModif, $usuario->getLogin(), $clave);

        else {
            header("Location: entradaUsuario.php?r=-1");
            exit();
        }
    } else {
        header("Location: entradaUsuario.php?r=-1");
        exit();
    }
} else {
    $r = $modelo->editSinClave($usuarioModif, $usuario->getLogin());
}


if ($cambioCorreo && $r > 0) {
    $r = $modelo->desactivar($usuario->getLogin());
    $id = md5($email . Configuracion::PEZARANA . $login); //mandar un enlace   http://....../phpConfirmar?id=23423re23423423423&login=tulogin  donde esa cadena será
    $url = Entorno::getEnlaceyCarpeta("phpConfirmarAlta.php?id=$id&login=$login");
    $enlace = "Pincha aqui: <a href='$url'>Confirmar alta en la página</a>";
    $r = Correo::enviarGmail(Configuracion::ORIGENGMAIL, $email, Configuracion::CLAVEGMAIL, "Alta en la Web para $nombre $apellido", $enlace);
    // $sesion->cerrar(); 
    header("Location: phpLogOut.php?r=1");
    exit();
}


$file->subir();
echo "Img: " . $file->getMensajeMultiple();
if ($file) {
    if ($file->getMensajeError() == "")
        $error = "Imagen de perfil cambiada con exito";
    else
        $error = $file->getMensajeError();
}
else
    $error = -1;

$sesion->setUsuario($usuarioModif);
header("Location: entradaUsuario.php?r=$r&file=$error");
?>


