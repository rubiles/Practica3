<?php

require '../require/comun.php';
$id = Leer::post("id");
$login = Leer::post("login");

$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);

$r = $modelo->cambiarClave($login, $id);

if ($r <= 0) {
    $bd->closeConexion();
    header("Location: ../index.php?error=6&valor=error");
    exit();
} else {
    $usuario = $modelo->getByLogin($login);

    $clave = Leer::post("clave");
    $clave2 = Leer::post("clave2");

    if ($clave === $clave2) {
        $nuevoUsuario = new Usuario($login, $clave, $usuario->getNombre(), $usuario->getApellido(), $usuario->getEmail());
        $bd = new BaseDatos();

        $r = $modelo->editConClave($nuevoUsuario, $usuario->getLogin(), $usuario->getClave());
        $bd->closeConexion();
        header("Location: ../index.php?error=6&valor=ok");
    }
    header("Location: ../index.php?error=6&valor=nocoinciden");
}