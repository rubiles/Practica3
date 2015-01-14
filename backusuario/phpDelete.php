<?php
require '../require/comun.php';

$login=Leer::request("login");

$bd=new BaseDatos();
$modelo=new ModeloUsuario($bd);
$r=$modelo->deletePorLogin($login);


/*$consultaSql = "delete from persona where id=:id;";
$param["id"]=$id;
$result=$bd->setConsulta($consultaSql, $param);
* 


$id=$bd->getAutonumerico();
$cuenta=$bd->getNumeroFilas();
 * 
 */
$bd->closeConexion();

//header("Location: index.php?operacion=Borrar&result=$result&id=$id&num_filas=$cuenta");       
header("Location: index.php?operacion=Borrar&result=$r");       
