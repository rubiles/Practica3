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
        $alta = Leer::get("alta");
        $bd = new BaseDatos();
        $modelo = new ModeloUsuario($bd);

        if ($alta == "ok")
            echo "<h2>Usuario Activado con Exito</h2>";
        else if ($alta == "ERROR")
            echo "<h2>Error- no se ha podido activar usuario</h2>";
        ?>
        <hr>
        <a href="login.php">LOGIN!</a>
    </body>
</html>
