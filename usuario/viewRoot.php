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
        <h1>SOLO PARA USUARIO ROOT</h1>
        <?php
        require '../require/comun.php';
        $sesion->autentificado("../index.php?error=2");
        echo "Entrado como admin-root"
        //$sesion declara en require!
        ?>
    </body>
</html>
