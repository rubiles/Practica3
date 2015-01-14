<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <style>
            input [readonly="readonly"]{background-color: gray;}
        </style>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../slider/engine1/style.css" />
        <script type="text/javascript" src="../slider/engine1/jquery.js"></script>

    </head>
    <body>
                <div id="logo"><h1>bytheFace</h1></div>

        <?php
        require '../require/comun.php';
        $bd = new BaseDatos();
        $modelo = new ModeloUsuario($bd);

        $op = Leer::get("op");
        if ($op)
            echo "<h3 class='error'>" . $op . "</h3>";
        ?>
        <form action="phpRecordar.php"  method="post">
            <table id="tabla_alta" border="1">
                <tr>
                    <th colspan="2"><h2>¿Olvidó su clave?</h2></th> 
                </tr>
                <tr>
                    <td>Usuario</td>
                    <td><input type="text" id="login" name="login" maxlength="30" size="30" placeholder="Login" /></td>
                </tr>
                <tr>
                    <td>Correo</td>
                    <td><input type="text" id="correo" name="correo"  maxlength="40" size="30"  placeholder="Correo" /></td>
                </tr>
                <tr>
                    <td colspan="2"><input class="submit" type="submit" value="Enviar mail" /></td> 
                </tr>
            </table>


        </form>

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