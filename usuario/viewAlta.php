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
        // put your code here
        ?>

        <h1>Darse de Alta</h1>
        <form action="phpAlta.php"  method="post">

            <table border="1">
                <tr>
                    <td>Login</td>
                    <td><input type="text" id="login" name="login" placeholder="Login" required/></td>
                </tr>
                <tr>
                    <td>Clave</td>
                    <td><input type="text" id="clave" name="clave" placeholder="Clave" required/></td>
                </tr>
                <tr>
                    <td>Confirmar Clave</td>
                    <td><input type="text" id="clave2" name="clave2" placeholder="Confirma Clave" required/></td>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td><input type="text" id="nombre" name="nombre" placeholder="Nombre" required/></td>
                </tr>
                <tr>
                    <td>Apellido</td>
                    <td><input type="text" id="apellido" name="apellido" placeholder="Apellido" required/></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" id="email" name="email" placeholder="Email" required/></td>
                </tr>

            </table>


            <input type="submit" value="Insertar" />
        </form>

    </body>
</html>
