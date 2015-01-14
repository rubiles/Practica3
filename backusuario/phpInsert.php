

<?php
require '../require/comun.php';
$bd=new BaseDatos();
$modelo=new ModeloUsuario($bd);

if(!$bd->isConectado()){
    header("Location: index.php?operacion=-1");
    exit();
}

$login=Leer::post("login");
$clave=Leer::post("clave");
$clave2=Leer::post("clave2");
$nombre=Leer::post("nombre");
$apellido=Leer::post("apellido");
$email=Leer::post("email");
$isactivo=Leer::post("isactivo");
$isroot=Leer::post("isroot");
$rol=Leer::post("rol");

$usuario=new Usuario($login, $clave, $nombre, $apellido, $email, null, $isactivo, $isroot, $rol, null);

if($clave == $clave2)
    $r=$modelo->add($usuario);
else
    $r=-1;


$bd->closeConexion();



header("Location: index.php?operacion=Insertar&result=$r");

