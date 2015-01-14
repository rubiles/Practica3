<?php

/*
  select * from usuario where md5(concat(email, "pez arana", login))='f4ab72d0117675c94b08109291b1a165&login=441'

  update usuario set isactivo=1 where md5(concat(email, "pez arana", login))='f4ab72d0117675c94b08109291b1a165&login=441'

 * 
 *      */



require '../require/comun.php';
$id = Leer::get("id");
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);

$r = $modelo->activa($id);



//  var_dump($r);
/*
  if($r==1)
  header("Location: viewAltaCorrecta.php?alta=ok&id=$id");
  else
  header("Location: viewAltaCorrecta.php?alta=ERROR&id=$id");
 */
if ($r == 1)
    header("Location: ../index.php?error=5&alta=ok&id=$id");
else
    header("Location: ../index.php?error=5&alta=ERROR&id=$id");
?>
