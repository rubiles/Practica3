<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require '../require/comun.php';
        $sesion->autentificado("../index.php?error=2");

        echo "LOGUEADO Y ENTRADO";

        $r = Leer::get("r");
        if ($r == 1)
        //echo "<br/>Modificado con exito".  var_dump($r)."<br/>";
            echo "<br/>Modificado con exito " . $r . "<br/>";
        else if ($r == -1)
            echo "<br/>Error al modificar " . ($r) . "<br/>";
        /*    if(!$sesion->isAutentificado()){
          echo "<h4>Hola, estas autentificado y olé</h4>";
          //$sesion->redirigir("viewprivado.php");

          }
          else
          header("Location: login.php?error=2");

         */
        ?>
        <a href="viewEditPerfil.php">Editar Mi Perfil</a>

    </body>
</html>
