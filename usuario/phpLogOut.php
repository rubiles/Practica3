<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="../css/style.css">

        <title></title>
    </head>
    <body>
        <?php
        require '../require/comun.php';
        //$sesion->autentificado("login.php?error=2");
        //$usuario=$sesion->getUsuario();

        $sesion->cerrar();
        ?>
        <div class="logout">      
            <?php
            $r = Leer::get("r");
            if ($r) {
                if ($r == 1)
                    header("Location: ../index.php?error=22");
            }
            else
                header("Location: ../index.php?error=2");
            ?>

        </div>
    </body>
</html>
