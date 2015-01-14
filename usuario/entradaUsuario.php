<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
            <?php
            require '../require/comun.php';
            $sesion->autentificado("../index.php?error=2");
            $usuario = $sesion->getUsuario();
            echo "Perfil de " . $usuario->getNombre() . " " . $usuario->getApellido();
            ?>      
        </title>
        <link rel="stylesheet" href="../css/style_usuario.css">
    </head>
    <body>
        <?php
        $r = Leer::get("r");
        $file = Leer::get("file");

        echo "<ul class='error'>";
        if ($r == 1)
        //echo "<br/>Modificado con exito".  var_dump($r)."<br/>";
            echo "<li>Modificado con exito</li>";
        else if ($r == -1)
            echo "<li>Error al modificar</li>";
        if ($file != -1)
            echo "<li>$file</li>";

        echo "</ul>"
        ?>
        <a href="viewEditPerfil.php">Editar Mi Perfil</a>
        <a href="phpLogout.php" id="cerrarSesion">Cerrar sesión</a>
        <h2 id="nombre"> <?php echo $usuario->getNombre() . " " . $usuario->getApellido(); ?> </h2>
        <?php
        $nombre_img = Archivos::devuelvePorNombre($usuario->getLogin());
        if ($nombre_img != -1)
            $img = "../image/" . $nombre_img;
        else
            $img = "../image/default.png"
            ?>  
        <img src="<?php echo $img; ?>" alt="Foto de Perfil" id="foto" />
    </body>
</html>
