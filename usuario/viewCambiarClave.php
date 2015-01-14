<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../slider/engine1/style.css" />
        <script type="text/javascript" src="../slider/engine1/jquery.js"></script>

    </head>
    <body>
        <div id="logo"><h1><a href="../index.php">bytheFace</a></h1></div>

        <?php
        require '../require/comun.php';
        $bd = new BaseDatos();
        $modelo = new ModeloUsuario($bd);

        $id = Leer::get("id");
        $login = Leer::get("login");
        $usuario = $modelo->getByLogin($login);
        $email = $usuario->getEmail();
        /* ME QEDE POR AQUÍ -> DEBERIA VIAJAR TB EL EMAIL PARA COMPROBAR EL ID.MD5 Y EN CASO DE QUE COINCIDA PERMITA CAMBIAR O NO LA CONTRASEÑA */

        $id2 = md5($login . Configuracion::PEZARANA . $email);
        if ($id2 == $id) {
            ?>
            <!--mostrar formulario cambiar contraseña -->
            <form action="phpCambiarClave.php" method="POST">   
                <table id="tabla_alta" border="1">
                    <tr>
                        <th colspan="2"><h1><?php echo $login; ?>, cambia tu clave</h1></th>
                    </tr>
                    <tr>
                        <td> <label for="clave">Contraseña</label></td>
                        <td><input type="password" name="clave"  size="30" value="" id="clave" required/>    </td>
                    </tr>
                    <tr>
                        <td> <label for="clave2">Confirmar Contraseña</label></td>
                        <td> <input type="password" name="clave2" size="30" value="" id="clave2" required/> 
                        </td>
                    </tr>

                    <tr>
                        <th colspan="2"> <input type="submit" class="submit" value="Cambiar Contraseña" /></th>
                    </tr>
                </table>                       

                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>"/>
                <input type="hidden" name="login" id="login" value="<?php echo $login; ?>"/>

            </form>


            <?php
        } else {
            header("Location: ../index.php?error=5&alta=ID incorrecto");
        }
        ?>


        <div id="wowslider-container1">
            <div class="ws_images"><ul>
                    <li><img src="../slider/data1/images/1.png" alt="facebook" title="facebook" id="wows1_0"/></li>
                    <li><img src="../slider/data1/images/2.jpg" alt="facebook-ayuda" title="facebook-ayuda" id="wows1_1"/></li>
                    <li><img src="../slider/data1/images/3.jpg" alt="Facebook-ilustración1" title="Facebook-ilustración1" id="wows1_2"/></li>
                    <li><img src="../slider/data1/images/4.png" alt="facebook-report-spam" title="facebook-report-spam" id="wows1_3"/></li>
                    <li><img src="../slider/data1/images/5.jpg" alt="full screen slider" title="Facebook-Search" id="wows1_4"/> </li>
                    <li><img src="../slider/data1/images/6.png" alt="facebook-timeline" title="facebook-timeline" id="wows1_5"/></li>
                </ul></div>
            <div class="ws_bullets"><div>
                    <a href="#" title="facebook"><img src="../slider/data1/tooltips/facebook.png" alt="facebook"/>1</a>
                    <a href="#" title="facebook-ayuda"><img src="../slider/data1/tooltips/facebookayuda.jpg" alt="facebook-ayuda"/>2</a>
                    <a href="#" title="Facebook-ilustración1"><img src="../slider/data1/tooltips/facebookilustracin1.jpg" alt="Facebook-ilustración1"/>3</a>
                    <a href="#" title="facebook-report-spam"><img src="../slider/data1/tooltips/facebookreportspam.png" alt="facebook-report-spam"/>4</a>
                    <a href="#" title="Facebook-Search"><img src="../slider/data1/tooltips/facebooksearch.jpg" alt="Facebook-Search"/>5</a>
                    <a href="#" title="facebook-timeline"><img src="../slider/data1/tooltips/facebooktimeline.png" alt="facebook-timeline"/>6</a>
                </div></div> 
            <div class="ws_shadow"></div>
        </div>	
        <script type="text/javascript" src="../slider/engine1/wowslider.js"></script>
        <script type="text/javascript" src="../slider/engine1/script.js"></script>

    </body>
</html>
