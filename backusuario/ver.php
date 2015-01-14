<?php
require "../require/comun.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
         <link rel="stylesheet" href="../css/style_root.css">
        <style>
                input {width:120px;} 
                th{background-color: lightgray;}
            
        </style>

    </head>
    <body>
        <?php
        $loginPK = Leer::request("login");
        echo $loginPK;

 //controlar que soy admin antes de editar....
 //$sesion->administrador("noRoot.php");
    
        $bd = new BaseDatos();
        $modelo = new ModeloUsuario($bd);
        $usuario = new Usuario($loginPK);
        $usuario = $modelo->get($usuario);
        $bd->closeConexion();
        ?>

        <form action="phpUpdate.php"  method="post">
           <input type="hidden"  name="loginPK" value="<?php echo $loginPK; ?>" />
            <table class="tabla_editar">
                <tr>
                    <th>Login</th>
                    <th>Clave</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>isActivo</th>
                    <th>isRoot</th>
                    <th>Rol</th>
                </tr>
                <tr>
                    
                    <td><input type="text" id="login" name="login" value="<?php echo $usuario->getLogin(); ?>" required/></td>
                    <td><input type="text" id="clave" name="clave"  value="<?php echo $usuario->getClave(); ?>" required/></td>
                    <td><input type="text" id="nombre" name="nombre" value="<?php echo $usuario->getNombre(); ?>" required/></td>
                    <td><input type="text" id="apellido" name="apellido"  value="<?php echo $usuario->getApellido(); ?>" required/></td>
                    <td><input type="text" id="email" name="email" value="<?php echo $usuario->getEmail(); ?>" required/></td> 
                    <td> <select id="isactivo" name="isactivo">
                        <?php  
                            if($usuario->getIsactivo()==0){
                         ?>
                             <option value="0" selected>No</option>
                             <option value="1">Si</option>
                         <?php
                            }     
                            else{
                        ?>
                            <option value="0">No</option>
                            <option value="1" selected>Si</option>
                         <?php } ?>   
                            
                        </select> 
                    </td>
                    <td>
                        <select id="isroot" name="isroot" >
                            <?php  
                                if($usuario->getIsroot()==0){
                             ?>
                                 <option value="0" selected>No</option>
                                 <option value="1">Si</option>
                             <?php
                                }     
                                else{
                            ?>
                                <option value="0">No</option>
                                <option value="1" selected>Si</option>
                             <?php } ?>   

                            </select> 
                    </td>
                    <td>
                      <select id="rol" name="rol"  >
                            <?php  
                                if($usuario->getRol()=='usuario'){
                             ?>
                                 <option value="usuario" selected>Usuario</option>
                                 <option value="administrador">Administrador</option>
                             <?php
                                }     
                                else{
                            ?>
                                  <option value="usuario" >Usuario</option>
                                 <option value="administrador" selected>Administrador</option>
                             <?php } ?>   

                            </select> 
                    
                    </td>
                </tr> 
                <tr>
                    <td colspan="8"> <input type="submit" class="submit" value="Actualizar Datos" /></td>
                </tr>
            </table>
                
        </form>
    </body>

    <!--
    pàra poider editar necesito la informacion completa, qe se la paso a otra pagina por id y hago la consulta y muestro la informacion en un formulario
    donde se modificara pero tengo q añadir en la consulta un input hidden con todos los id q tenga la tabla. 
    en caso de que se pueda modificar la clave principal de la tabla, tengo q hacer 2 cosas
    guardar el anterior en un hidden para saber la version correcta en caso de fallo y a la vez  mostrarla en otro input type text para modificarla.
    en caso de "exito" se qeda el nuevo, si no tengo el antiguo para dejarlo coomo staba pero con los datos nuevos (excepto el id) y tambien para poder modificarlo
    ya que para la consulta update. para saber a quien modificar necesito el id antiguo
    
    update persona where id=id_antiguo set id=id_nuevo
    
    para no perder el id_antiguo tendra q viajar como hidden
    -->
</html>

