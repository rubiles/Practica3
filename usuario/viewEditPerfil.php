<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php
            require '../require/comun.php';
            $sesion->autentificado("../index.php?error=2");
            $usuario = $sesion->getUsuario();
            echo "Editar perfil de" . $usuario->getNombre() . " " . $usuario->getApellido();
            ?>      
        </title>
        <link rel="stylesheet" href="../css/style_editarusuario.css">

        <!--PASSWORD CHECKER -->        
        <script src="../js/jquery-1.4.4.min.js" type="text/javascript"></script>
        <link href="../css/demo_pschecker.css" rel="stylesheet" type="text/css" />
        <link href="../css/style_pschecker.css" rel="stylesheet" type="text/css" />
        <script src="../js/pschecker.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                //Demo code
                $('.password-container').pschecker({onPasswordValidate: validatePassword, onPasswordMatch: matchPassword});

                var submitbutton = $('.submito');
                var errorBox = $('.error');
                errorBox.css('visibility', 'hidden');
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

        <?php
        // require '../require/comun.php';
        //$sesion->autentificado("login.php?error=2");
        // $usuario=$sesion->getUsuario();
        ?>
        <div class="password-container">
            <form action="editPerfil.php"  method="post" enctype="multipart/form-data">
                <table id="tabla_alta" border="1">
                    <tr>
                        <th colspan="2"> <h1>Editar Perfil</h1></th>
                    </tr>

                    <tr>
                        <td>Login</td>
                        <td><input type="text" id="login"  maxlength="30" size="40" name="login" value="<?php echo $usuario->getLogin(); ?>" readonly required/></td>
                    </tr>
                    <tr>
                        <td>Clave Antigua</td>
                        <td><input type="text" size="40" maxlength="40"   id="clave" name="clave"  /></td>
                           <td rowspan="3"><div class="meter" style="width:100px;margin-top: 10px; height: 1.2em;"></div></td>
                    </tr>
                    <tr>
                        <td>Clave Nueva</td>
                        <td><input type="password" class="strong-password" size="40" maxlength="40"   id="clavenueva1" name="claven1"  /></td>
                     
                    </tr>

                    <tr>
                        <td>Repita Clave Nueva</td>
                        <td><input type="password"  class="strong-password" size="40"  maxlength="40"  id="clavenueva2" name="claven2"  /></td>
                    </tr>

                    <tr>
                        <td>Nombre</td>
                        <td><input type="text" size="40" maxlength="40"   id="nombre" name="nombre" value="<?php echo $usuario->getNombre(); ?>" required/></td>
                    </tr>
                    <tr>
                        <td>Apellido</td>
                        <td><input type="text" size="40" maxlength="60"   id="apellido" name="apellido"  value="<?php echo $usuario->getApellido(); ?>" required/></td>
                    </tr>

                    <tr>
                        <td>Email</td>
                        <td><input type="email" size="40" maxlength="40"   id="email" name="email" value="<?php echo $usuario->getEmail(); ?>" required/></td>
                    </tr>
                    <tr>
                        <td>Foto de Perfil</td>
                        <td><input type="file" id="imagen" name="imagen" /></td>
                    </tr>
                    <tr>
                        <th colspan="2"> <input type="submit" class="submit" value="Actualizar Datos" /></th>
                    </tr>

                </table>

            </form>
        </div>     

        <a href="entradaUsuario.php">Volver a mi Perfil</a>

        <h2 id="nombre2"> <?php echo $usuario->getNombre() . " " . $usuario->getApellido(); ?> </h2>
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
