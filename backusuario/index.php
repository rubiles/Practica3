<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="../css/style_root.css">
        <script src="../js/main.js"></script>
           
    </head>
    <body>

        <?php
        require '../require/comun.php';
   
 //AÑADIR ESTO A TODOS LOS BACKEND PARA QUE NO PUEDAN ACCEDER AQI NADA MAS Q USUARIOS       
        $sesion->administrador("noRoot.php");
        
        $bd = new BaseDatos();
        $modelo = new ModeloUsuario($bd);
        
        
//MENSAJES
       $op=Leer::get("operacion");
       $result=Leer::get("result");  
       if($op && $result){
          if($result!=1)
            echo "<h3 class='error'>La operación $op no se llevó a cabo</h3>";
          else
            echo "<h3 class='error'>La operación $op se ha realizado con exito</h3>";
       }


/*PAGINACION*/
    $pagina = 0;
    if (Leer::get("pagina") != null) {
        $pagina = Leer::get("pagina");
    }
    
    $filas = $modelo->getListPaginado($pagina, Configuracion::RPP);
    $enlaces = Util::getEnlacesPaginacion($pagina, $modelo->count(), Configuracion::RPP);

    
    
//FILTROS        
  /*PAGINA DONDE ESTAMOS -> PARA CONSTRUIR ENLACES: */
   if(Entorno::getParametros()!="")  
        $url=  Entorno::getPagina()."?".Entorno::getParametros()."&";
   else
       $url=  Entorno::getPagina()."?";
 

        $buscar=Leer::get("buscar");
        $orden=Leer::get("orden");
        echo $orden;
        
        if($buscar){
            $param["login"]=$buscar;
            if($orden){
                $filas = $modelo->getListPaginado($pagina, Configuracion::RPP, "login LIKE '%".$buscar."%' ",array(),$orden);
                $enlaces = Util::getEnlacesPaginacion($pagina, $modelo->count("login LIKE '%".$buscar."%' ",array()), Configuracion::RPP, $url);
           }
            else{
                $filas = $modelo->getListPaginado($pagina, Configuracion::RPP, "login LIKE '%".$buscar."%' ");
                $enlaces = Util::getEnlacesPaginacion($pagina, $modelo->count("login LIKE '%".$buscar."%' "), Configuracion::RPP, $url);
            }
            if($filas==null){
              $filas = $modelo->getListPaginado($pagina, Configuracion::RPP, $url);
              $enlaces = Util::getEnlacesPaginacion($pagina, $modelo->count(), Configuracion::RPP, $url);
            }
       }
        else{
            $buscar="";
            if($orden){
                $filas = $modelo->getListPaginado($pagina, Configuracion::RPP, "1=1",array(),$orden);
                $enlaces = Util::getEnlacesPaginacion($pagina, $modelo->count("1=1",array()), Configuracion::RPP, $url);
            }
            else{  
                $filas = $modelo->getListPaginado($pagina, Configuracion::RPP);
                $enlaces = Util::getEnlacesPaginacion($pagina, $modelo->count(), Configuracion::RPP, $url);
            }
        }
 

   ?>

 
 
      <h1>Listado de Usuarios</h1>
      <a href="../usuario/phpLogout.php" id="cerrarSesion">Cerrar sesión</a>
      <div class="filtros">
        <form action="index.php"  method="get">
          <label>Buscar: </label>
          <input type="text" name="buscar" id="buscar" value="<?php echo $buscar; ?>"/>
          <input type="submit"  value="Buscar Usuario"/>
        </form>
         <h3>Teclee la cabecera de la tabla para ordenar por el campo deseado</h3>  
      </div>
     
        <table border="1">
            <tr>
                <td><a href="<?php echo $url; ?>orden=login">Login</a></td>
                <td><a href="<?php echo $url; ?>orden=clave">Clave</a></td>
                <td><a href="<?php echo $url; ?>orden=nombre">Nombre</a></td>
                <td><a href="<?php echo $url; ?>orden=apellido">Apellido</a></td>
                <td><a href="<?php echo $url; ?>orden=email">Email</a></td>
                <td><a href="<?php echo $url; ?>orden=fechaalta">FechaAlta</a></td>
                <td><a href="<?php echo $url; ?>orden=isactivo">isActivo</a></td>
                <td><a href="<?php echo $url; ?>orden=isroot">isRoot</a></td>
                <td><a href="<?php echo $url; ?>orden=rol">Rol</a></td>
                <td><a href="<?php echo $url; ?>orden=fechalogin">FechaLogin</a></td>
                <td colspan="3">Operaciones</td>
            </tr>
            <?php
            foreach ($filas as $indice => $objeto) {
                ?>

                <tr>
                    <td><?php echo $objeto->getLogin() ?></td>
                    <td><?php echo $objeto->getClave() ?></td>
                    <td><?php echo $objeto->getNombre() ?></td>
                    <td><?php echo $objeto->getApellido() ?></td>
                    <td><?php echo $objeto->getEmail() ?></td>
                    <td><?php 
                            date_default_timezone_set('UTC');
                            $time = strtotime($objeto->getFechaalta());
                            $myFormatForView = date("d/m/Y", $time);         
                             echo $myFormatForView; 
                            ?></td>
                    <td><?php echo $objeto->getIsactivo() ?></td>
                    <td><?php echo $objeto->getIsroot() ?></td>
                    <td><?php echo $objeto->getRol() ?></td>
                    <td><?php 
                          
                            $time = strtotime($objeto->getFechalogin());
                            $myFormatForView = date("d/m/Y H:i", $time);         
                             echo $myFormatForView; 
                             ?></td>

                    <td class="opciones"><a class="borrar" data-nombre="<?php echo $objeto->getNombre() . " " . $objeto->getApellido(); ?>" href="phpDelete.php?login=<?php echo $objeto->getLogin(); ?>" >BORRAR</a></td>
                    <td  class="opciones"><a href="ver.php?login=<?php echo $objeto->getLogin(); ?>" >EDITAR</a></td>
                    <td  class="opciones"><a href="baja.php?login=<?php echo $objeto->getLogin(); ?>" >DAR DE BAJA</a></td>
                </tr>
            <?php } ?>
                <tr>
                   <th colspan="13">
                    <?php echo $enlaces["inicio"]; ?>
                    <?php echo $enlaces["anterior"]; ?>
                    <?php echo $enlaces["primero"]; ?>
                    <?php echo $enlaces["segundo"]; ?>
                    <?php echo $enlaces["actual"]; ?><!-- normalmente -->
                    <?php echo $enlaces["cuarto"]; ?>
                    <?php echo $enlaces["quinto"]; ?>
                    <?php echo $enlaces["siguiente"]; ?>
                    <?php echo $enlaces["ultimo"]; ?>
                   </th>
                </tr>
               
        </table>
 
     
 <div class="seccion2">      
        <h1>Insertar Nuevo</h1>
   
        <form action="phpInsert.php"  method="post">
        <table>
                <tr>
                    <th>Login</th>
                    <th>Clave</th>
                    <th>Confirma Clave</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>isActivo</th>
                    <th>isRoot</th>
                    <th>Rol</th>
                </tr>
                <tr>
                    
                    <td><input type="text" id="login"  maxlength="30" name="login" required/></td>
                    <td><input type="text" id="clave"  maxlength="40" name="clave"   required/></td>
                    <td><input type="text" id="clave2"  maxlength="40" name="clave2"   required/></td>
                    <td><input type="text" id="nombre" maxlength="30"  name="nombre" required/></td>
                    <td><input type="text" id="apellido"  maxlength="60"  name="apellido"  required/></td>
                    <td><input type="text" id="email"  maxlength="40"  name="email"  required/></td> 
                    <td> 
                        <select id="isactivo" name="isactivo">
                           <option value="0" selected>No</option>
                           <option value="1">Si</option> 
                        </select> 
                    </td>
                    <td>
                        <select id="isroot" name="isroot" >
                          <option value="0" selected>No</option>
                          <option value="1">Si</option>   
                        </select> 
                    </td>
                    <td>
                      <select id="rol" name="rol">
                           <option value="usuario" selected>Usuario</option>
                           <option value="administrador">Administrador</option>
                      </select> 
                    
                    </td>
                </tr> 
                <tr>
                    <td colspan="9"> <input type="submit" class="submit" value="Crear Usuario" /></td>
                </tr>
            </table>
       
        </form>
 </div>

    
    </body>
</html>
