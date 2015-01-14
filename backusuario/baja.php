<?php
require "../require/comun.php";


$login=Leer::get("login");
$bajaLogin="z_".$login;

$bd=new BaseDatos();
$modelo=new ModeloUsuario($bd);

$usuarioOld=$modelo->getByLogin($login);
$usuario=new Usuario($bajaLogin, $usuarioOld->getClave(), $usuarioOld->getNombre(), $usuarioOld->getApellido(), $usuarioOld->getEmail(), null, 0, $usuarioOld->getIsroot(), $usuarioOld->getRol(), null);


$r=$modelo->darBaja($usuario, $login);

//echo var_dump($bd->getError());
$bd->closeConexion();


header("Location: index.php?operacion=DardeBaja&result=$r");


