
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>

        <form action="phpCorreo.php"  method="post">
            <input type="text" name="origen" value="" placeholder="origen" /><br/>
            <input type="text" name="destino" value="" placeholder="destino" /><br/>
            <input type="password" name="clave" value="" placeholder="clave" /><br/>
            <input type="text" name="asunto" value=""  placeholder="asunto"/><br/>
            <input type="text" name="mensaje" value=""  placeholder="mensaje"/><br/>
            <input type="submit" value="Enviar correo"/>

        </form>
        <?php
        ?>
    </body>
</html>
