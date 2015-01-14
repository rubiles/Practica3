<?php
require "../require/comun.php";

$loginPK=Leer::post("loginPK");
$login=Leer::post("login");
$clave=Leer::post("clave");
$nombre=Leer::post("nombre");
$apellido=Leer::post("apellido");
$email=Leer::post("email");
$isactivo=Leer::post("isactivo");
$isroot=Leer::post("isroot");
$rol=Leer::post("rol");



$bd=new BaseDatos();
$usuario=new Usuario($login, $clave, $nombre, $apellido, $email, null, $isactivo, $isroot, $rol, null);



$modelo=new ModeloUsuario($bd);
$r=$modelo->editPK($usuario, $loginPK);



$bd->closeConexion();

//header("Location: index.php?operacion=Update&result=$result&id=$id&num_filas=$filas_m");
header("Location: index.php?operacion=Actualizar&result=$r");


