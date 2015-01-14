<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" type="text/css" href="./slider/engine1/style.css" />
        <script type="text/javascript" src="./slider/engine1/jquery.js"></script>

        <!--PASSWORD CHECKER -->        
        <script src="./js/jquery-1.4.4.min.js" type="text/javascript"></script>
        <link href="./css/demo_pschecker.css" rel="stylesheet" type="text/css" />
        <link href="./css/style_pschecker.css" rel="stylesheet" type="text/css" />
        <script src="./js/pschecker.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                //Demo code
                $('.password-container').pschecker({onPasswordValidate: validatePassword, onPasswordMatch: matchPassword});

                var submitbutton = $('.submit');
                var errorBox = $('.error23');
                // errorBox.css('visibility', 'hidden');
                submitbutton.attr("disabled", "disabled");

                //this function will handle onPasswordValidate callback, which mererly checks the password against minimum length
                function validatePassword(isValid) {
                    if (!isValid)
                        errorBox.css('visibility', 'visible');
                    else
                        errorBox.css('visibility', 'hidden');
                }
                //this function will be called when both passwords match
                function matchPassword(isMatched) {
                    if (isMatched) {
                        submitbutton.addClass('unlocked').removeClass('locked');
                        submitbutton.removeAttr("disabled", "disabled");
                    }
                    else {
                        submitbutton.attr("disabled", "disabled");
                        submitbutton.addClass('locked').removeClass('unlocked');
                    }
                }
            });
        </script>

    </head>
    <body>
        <div id="logo"><h1>bytheFace</h1></div>
        <?php
        require './require/comun.php';
        $error = Leer::get("error");
        $bd = new BaseDatos();
        $modelo = new ModeloUsuario($bd);

        if ($error == 1)
            echo "<h2 class='error'>Contraseña o Login incorrecto- Intentelo de nuevo.</h2>";
        else if ($error == 2)
            echo "<h2 class='error'>Sesion cerrada, vuelva a identificarse.</h2>";
        else if ($error == 22)
            echo "<h2 class='error'>Ha modificado con exito el correo de su cuenta y se ha cerrado la sesión, por favor chequee su correo y proceda a la verificación del mismo </h2>";
        else if ($error == 3)
            echo "<h2 class='error'>Debe activar primero su usuario, verifique su email.</h2>";
        else if ($error == 4) {
            if (Leer::get("operacion"))
                echo "<h2 class='error'>Dado de alta con exito, revise su email para verificar su cuenta.</h2>";
        }
        else if ($error == 5) {
            $alta = Leer::get("alta");
            if ($alta == "ok")
                echo "<h2 class='error'>Dado de alta con exito, ya puede loguearse.</h2>";
            else if ($alta == "error")
                echo "<h2 class='error'>Error al verificar su email, intentelo de nuevo.</h2>";
            else
                echo "<h2 class='error'>Las claves no coinciden, intentelo de nuevo.</h2>";
        }
        else if ($error == 6) {
            $valor = Leer::get("valor");
            if ($valor == "ok")
                echo "<h2 class='error'>Clave cambiada con exito, ya puede loguearse.</h2>";
            else if ($valor == "error")
                echo "<h2 class='error'>No se pudo modificar la clave, intentelo de nuevo.</h2>";
            else
                echo "<h2 class='error'>Las claves no coinciden, intentelo de nuevo.</h2>";
        }
        else if ($error == 7) {
            echo "<h2 class='error'>Revise su email para cambiar su clave.</h2>";
        } else if ($error == 8) {
            echo "<h2 class='error'>Ese login no existe, intentelo de nuevo o verifique vía email.</h2>";
        } else if ($error == 9) {
            echo "<h2 class='error'>Ese correo no existe, intentelo de nuevo.</h2>";
        }
        ?>
        <form action="./usuario/phpLogin.php"  method="post">
            <table id="tabla_login" border="1">
                <tr>
                    <td>Usuario</td>
                    <td><input type="text" id="login" name="login"  maxlength="30"  placeholder="Usuario" required/></td>
                    <td>Contraseña</td>
                    <td><input type="text" id="clave" name="clave" maxlength="40"  placeholder="Contraseña" required/></td> 
                    <td> <input type="submit" id="submit" value="Entrar" /></td>
                </tr>
                <tr>
                    <td colspan="5"> <a href="./usuario/view_recordar.php" id="recordar">Recordar Login ó Contraseña</a></td>
                </tr>
            </table>


        </form>


        <div class="password-container">  
            <form action="./usuario/phpAlta.php"  method="post">
                <table id="tabla_alta" border="1">
                    <tr>
                        <th colspan="2"><h1>¡Date de Alta ahora!</h1></th>
                    </tr>
                    <tr>
                        <td><label>Usuario</label></td>
                        <td><input type="text" id="login" size="40" maxlength="30" name="login" placeholder="Usuario" required/></td>
                    <tr> 

                        <td><label>Contraseña</label></td>
                        <td><input class="strong-password" type="password" id="clave" size="40" maxlength="40"  name="clave" placeholder="Contraseña" required/></td>
                    </tr>
                    <tr>
                        <td><label>Confirmar Contraseña</label></td>
                        <td><input class="strong-password" type="password" id="clave2" size="40"  maxlength="40"  name="clave2" placeholder="Confirma Contraseña" required/></td>
                    </tr>
                    <tr><td colspan="2"><div class="meter"></div></td> </tr>   
                    <tr>
                        <td><label>Nombre</label></td>
                        <td><input type="text" id="nombre"  size="40" maxlength="30"  name="nombre" placeholder="Nombre" required/></td>
                    </tr>
                    <tr>
                        <td><label>Apellido</label></td>
                        <td><input type="text" id="apellido"  size="40"  maxlength="60"  name="apellido" placeholder="Apellido" required/></td>
                    </tr>
                    <tr>
                        <td><label>Email</label></td>
                        <td><input type="email" id="email"  size="40" maxlength="40"  name="email" placeholder="Email" required/></td>
                    </tr>
                    <tr>
                        <th colspan="2"> <input type="submit" class="submit" value="Date de Alta" /></th>
                    </tr>
                </table>

            </form>
        </div>        
        <div id="wowslider-container1">
            <div class="ws_images"><ul>
                    <li><img src="./slider/data1/images/1.png" alt="facebook" title="facebook" id="wows1_0"/></li>
                    <li><img src="./slider/data1/images/2.jpg" alt="facebook-ayuda" title="facebook-ayuda" id="wows1_1"/></li>
                    <li><img src="./slider/data1/images/3.jpg" alt="Facebook-ilustración1" title="Facebook-ilustración1" id="wows1_2"/></li>
                    <li><img src="./slider/data1/images/4.png" alt="facebook-report-spam" title="facebook-report-spam" id="wows1_3"/></li>
                    <li><img src="./slider/data1/images/5.jpg" alt="full screen slider" title="Facebook-Search" id="wows1_4"/> </li>
                    <li><img src="./slider/data1/images/6.png" alt="facebook-timeline" title="facebook-timeline" id="wows1_5"/></li>
                </ul></div>
            <div class="ws_bullets"><div>
                    <a href="#" title="facebook"><img src="./slider/data1/tooltips/facebook.png" alt="facebook"/>1</a>
                    <a href="#" title="facebook-ayuda"><img src="./slider/data1/tooltips/facebookayuda.jpg" alt="facebook-ayuda"/>2</a>
                    <a href="#" title="Facebook-ilustración1"><img src="./slider/data1/tooltips/facebookilustracin1.jpg" alt="Facebook-ilustración1"/>3</a>
                    <a href="#" title="facebook-report-spam"><img src="./slider/data1/tooltips/facebookreportspam.png" alt="facebook-report-spam"/>4</a>
                    <a href="#" title="Facebook-Search"><img src="./slider/data1/tooltips/facebooksearch.jpg" alt="Facebook-Search"/>5</a>
                    <a href="#" title="facebook-timeline"><img src="./slider/data1/tooltips/facebooktimeline.png" alt="facebook-timeline"/>6</a>
                </div></div> 
            <div class="ws_shadow"></div>
        </div>	
        <script type="text/javascript" src="./slider/engine1/wowslider.js"></script>
        <script type="text/javascript" src="./slider/engine1/script.js"></script>

    </body>
</html>
