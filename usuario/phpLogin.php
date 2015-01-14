<?php

require '../require/comun.php';
$login = Leer::post("login");
$clave = Leer::post("clave");

$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);

$r = $modelo->isLogin($login, $clave);


if ($r->getLogin() == $login && $r->getClave() == sha1($clave)) {
    //if($r instanceof Usuario) {
    //  echo "LOGUEADO CON EXITO";
    if ($r->getIsactivo() != 0) {
        if ($r->getIsroot() != 0) {
            $sesion->setUsuario($r);
            header("Location: ../backusuario/index.php");
        } else {
            $sesion->setUsuario($r);
            header("Location: entradaUsuario.php");
        }
    } else {
        $sesion->cerrar();
        header("Location: ../index.php?error=3");
    }
} else {
    $sesion->cerrar();
    header("Location: ../index.php?error=1");
}
?>
