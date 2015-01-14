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
        $error = Leer::get("error");
        $bd = new BaseDatos();
        $modelo = new ModeloUsuario($bd);

        if ($error == 1)
            echo "<h2>Contraseña o Login incorrecto- Intentelo de nuevo</h2>";
        else if ($error == 2)
            echo "<h2>Sesion cerrada, vuelva a identificarse</h2>";
        else if ($error == 3)
            echo "<h2>Debe activar primero su usuario, verifique su email</h2>";
        ?>
        <form action="phpLogin.php"  method="post">
            <table border="1">
                <tr>
                    <td>Login</td>
                    <td><input type="text" id="login" name="login" placeholder="Login" required/></td>
                </tr>
                <tr>
                    <td>Clave</td>
                    <td><input type="text" id="clave" name="clave" placeholder="Clave" required/></td>
                </tr>
            </table>
            <input type="submit" value="Entrar" />
            <a href="view_recordar.php">Recordar Login ó Contraseña</a>
        </form>
    </body>
</html>
