<?php

class ModeloUsuario {

    private $bd = null;
    private $tabla = "usuario";

    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }

    /* INSERTAR */
    /* EN CFUNCION SI MI TABLA TIENE O NO AUTONUMERICO DEVOLVEREMOS DISTINTAS COSAS
     * EN CASO DE NO TENER AUTONUMERICO SOLO DEVOLVERIAMOS EN PLAN TRUE/FALSE O 0/1 PARA SABER SI SE HA INSERTADO O NO
     * EN CASO DE AUTONUMERICO DEBEMOS DEVOLVER EL ID INSERTADO SI SE HA INSERTADO U 0 o -1 o LO Q SEA EN CASO DE Q NO SE HA INSERTADO.
     * 
     * PARA HACERLO GENERICO DEVOLVEREMOS -1 EN CASO DE ERROR, 0 EN CASO DE NO AUTONUMERICO O EL ID EN CASO D AUTONUMERICO
     */

    function add(Usuario $objeto) {
        $sql = "insert into $this->tabla values (:login, :clave, :nombre, :apellido, :email, curdate(), :isactivo, :isroot, :rol, null);";
        $parametro["login"] = $objeto->getLogin();
        $parametro["clave"] = sha1($objeto->getClave());
        $parametro["nombre"] = $objeto->getNombre();
        $parametro["apellido"] = $objeto->getApellido();
        $parametro["email"] = $objeto->getEmail();

        $parametro["isactivo"] = $objeto->getIsactivo();
        $parametro["isroot"] = $objeto->getIsroot();
        $parametro["rol"] = $objeto->getRol();

        $result = $this->bd->setConsulta($sql, $parametro);

        if (!$result)
            return -1;
        //en este caso es autonumerico
        return $result;
    }

    /* BORRAR */

    function delete(Usuario $objeto) {
        $sql = "delete from $this->tabla where login = :login;";
        $parametro["login"] = $objeto->getLogin();
        $result = $this->bd->setConsulta($sql, $parametro);
        if (!$result)
            return -1;

        return $result;
    }

    function deletePorLogin($login) {
        return $this->delete(new Usuario($login));
    }

    /* EDITAR */

//TENDREMOS UN EDIT PARA CUANDO SE SU ID Y PARA CUANDO NO LO SE (y me mandarian el original y el nuevo)
    function edit(Usuario $objeto) {
        $sql = "update $this->tabla SET clave= :clave, nombre= :nombre, apellido= :apellido, email=:email, isactivo= :isactivo, isroot= :isroot, rol= :rol WHERE login= :login);";
        $parametro["login"] = $objeto->getLogin();
        $parametro["clave"] = sha1($objeto->getClave());
        $parametro["nombre"] = $objeto->getNombre();
        $parametro["apellido"] = $objeto->getApellido();
        $parametro["email"] = $objeto->getEmail();
        $parametro["isactivo"] = $objeto->getIsactivo();
        $parametro["isroot"] = $objeto->getIsroot();
        $parametro["rol"] = $objeto->getRol();
        $parametro["fechalogin"] = $objeto->getFechalogin();

        $result = $this->bd->setConsulta($sql, $parametro);
        if (!$result)
            return -1;
        return $this->bd->getNumeroFilas();
    }

    function editPK(Usuario $objeto, $loginPK) {
        $sql = "update $this->tabla SET login= :login, clave= :clave, nombre= :nombre, 
            apellido= :apellido, email= :email, isactivo= :isactivo, isroot= :isroot, rol= :rol WHERE login= :loginPK;";
        echo $sql;

        $parametro["login"] = $objeto->getLogin();       //NUEVO LOGIN
        $parametro["clave"] = sha1($objeto->getClave());
        $parametro["nombre"] = $objeto->getNombre();
        $parametro["apellido"] = $objeto->getApellido();
        $parametro["email"] = $objeto->getEmail();
        $parametro["isactivo"] = $objeto->getIsactivo();
        $parametro["isroot"] = $objeto->getIsroot();
        $parametro["rol"] = $objeto->getRol();
        $parametro["loginPK"] = $loginPK;  //VIEJO LOGIN DEL ORIGINAL

        $result = $this->bd->setConsulta($sql, $parametro);

        echo "<hr/>Result: $result";

        if (!$result)
            return -1;
        echo "<hr/>NumFilas ".$this->bd->getNumeroFilas();
        return $this->bd->getNumeroFilas();
    }

    
     function darBaja(Usuario $objeto, $loginPK) {
        $sql = "update $this->tabla SET login= :login, isactivo= 0 WHERE login= :loginPK;";
        echo $sql;

        $parametro["login"] = $objeto->getLogin();       //NUEVO LOGIN
        $parametro["loginPK"] = $loginPK;  //VIEJO LOGIN DEL ORIGINAL

        $result = $this->bd->setConsulta($sql, $parametro);

        echo "<hr/>Result: $result";

        if (!$result)
            return -1;
        echo "<hr/>NumFilas ".$this->bd->getNumeroFilas();
        return $this->bd->getNumeroFilas();
    }
    
    
    /* GET OBJETO COMPLETO=SELECT */

    function get(Usuario $objeto) {
        $sql = "SELECT * FROM $this->tabla WHERE login= :login;";
        $parametro["login"] = $objeto->getLogin();
        $result = $this->bd->setConsulta($sql, $parametro);
        if (!$result)
            return null;
        else {
            $usuario = new Usuario();
            $usuario->set($this->bd->getFila());
            return $usuario;
        }
    }

  function getByLogin($login) {
        $sql = "SELECT * FROM $this->tabla WHERE login= :login;";
        $parametro["login"] = $login;
        $result = $this->bd->setConsulta($sql, $parametro);
        if (!$result)
            return null;
        else {
            $usuario = new Usuario();
            $usuario->set($this->bd->getFila());
            return $usuario;
        }
    }
   function getFiltroByLogin($login) {
        $sql = "SELECT * FROM $this->tabla WHERE login LIKE %:login%;";
        $parametro["login"] = $login;
        $result = $this->bd->setConsulta($sql, $parametro);
        if (!$result)
            return null;
        else {
            $usuario = new Usuario();
            $usuario->set($this->bd->getFila());
            return $usuario;
        }
    } 
     function getCorreo($correo) {
        $parametro["email"] = $correo;
        $result =$this->getList("email= :email", $parametro);
        if (!$result)
            return null;
        else {
           return $result;
        }
    }
    //ESTOS LA LLAMAN AUTENTIFICA
   function isLogin($login, $clave) {
        $sql = "SELECT * FROM $this->tabla WHERE login= :login AND clave= :clave;";
        $parametros["login"] = $login;
        $parametros["clave"] = sha1($clave);
       $result = $this->bd->setConsulta($sql, $parametros);
        
        if (!$result)
            return false;
        else {
            $usuario = new Usuario();
            $usuario->set($this->bd->getFila());
            $this->actualizaFechaLogin($login);       
            return $usuario;
        }
    }
    
    function actualizaFechaLogin($login){
        $this->editConsulta("fechalogin= now()", "login='$login'");
    }
    
    function isLogin2($login, $clave) {
        $condicion=" login= :login AND clave= :clave AND isactivo=1";
        $parametros["login"] = $login;
        $parametros["clave"] = sha1($clave);
        $result=$this->getList($condicion, $parametros);
        if (!$result)
            return false;
        else {
            $usuario = new Usuario();
            $usuario->set($this->bd->getFila());
            return $usuario;
        }
    }
    
     function count($condicion = "1=1", $parametros = array()) {
        $sql = "select count(*) from $this->tabla where $condicion";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            $aux=$this->bd->getFila();
            return $aux[0];
        }
        return -1;
    }
     function count2($condicion = "1=1", $parametros = array()) {
        $sql = "SELECT count(*) FROM $this->tabla WHERE $condicion";
        $result = $this->bd->setConsulta($sql, $parametros);
        if ($result)
        // return $this->bd->getFila()[0];     //en vez de devolver un array con un numero, devuelvo directamente una variable entera normal con el numero
            return $result;
        return -1;
    }

    function getList($condicion = "1=1", $parametros = array(), $orderBy = "1") {
        $list = array();
        $sql = "SELECT * FROM $this->tabla WHERE $condicion order by $orderBy";
        $result = $this->bd->setConsulta($sql, $parametros);
        if ($result) {
            while ($fila = $this->bd->getFila()) {
                $usuario = new Usuario();
                $usuario->set($fila);
                $list[] = $usuario;
            }
            return $list;
        }
        return null;
    }

   function getListPaginado($pagina = 0, $rpp = 10, $condicion = "1=1", $parametros = array(), $orderby = "1") {
        $pos = $pagina * $rpp;
        $sql = "select * from ". $this->tabla ." where $condicion order by $orderby limit $pos, $rpp";
        $r = $this->bd->setConsulta($sql, $parametros);
        $respuesta = array();
        while ($fila = $this->bd->getFila()) {
            $objeto = new Usuario();
            $objeto->set($fila);
            $respuesta[] = $objeto;
        }
        return $respuesta;
    }
    
    
     function getListJSON($condicion = "1=1", $parametros = array(), $orderBy = "1") {
        $list = array(); //$list = [];
        $sql = "select * from $this->tabla where $condicion order by $orderBy";
        $this->bd->setConsulta($sql, $parametros);
        $r="[";
            while ($fila = $this->bd->getFila()) {
                $usuario = new Usuario();
                $usuario->set($fila);
               $r.=$usuario->getJSON().",";
             
            }
            $r.=substr($r,0,-1)."]";
            
        return $r;
    }
    
    
    
      function getListJSONPaginado($pagina=0, $rpp=3, $condicion = "1=1", $parametros = array(), $orderBy = "1") {
        $pos=$pagina*$rpp;
        $sql = "select * from $this->tabla where $condicion order by $orderBy LIMIT $pos, $rpp";
        $this->bd->setConsulta($sql, $parametros);
        $r="[";
            while ($fila = $this->bd->getFila()) {
                $usuario = new Usuario();
                $usuario->set($fila);
               $r.=$usuario->getJSON().",";
            }
            $r=substr($r,0,-1)."]";
            
        return $r;
    } 
    
    
    function selectHTML($id, $name, $condicion, $parametros, $orderby = 1, $valorSeleccionado = "", $blanco = true, $textoBlanco = "&nbsp;") {

        $select = "<select name=$name id=$id>";

        if ($blanco)
            $select.="<option value=''>$textoBlanco</option>";

        //getlist
        $lista = $this->getList($condicion, $parametros, $orderby);

        //while y meter todas las opciones
        foreach ($lista as $objeto) {
            $selected = "";
            if ($objeto->getLogin() == $valorSeleccionado)         //en caso del valor x defecto seleccionado
                $selected = "selected";

            $select.="<option $selected value='" . $objeto->getLogin() . "'>" . $objeto->getApellido() . ", " . $objeto->getNombre() . "</option>";
        }


        $select.="</select>";
        return $select;
    }

    
     function activa($id) {
       $sql = 'update usuario 
           SET isactivo=1 
           WHERE isactivo=0 AND md5(concat(email, "'.Configuracion::PEZARANA.'", login))= :id';
       echo $sql;
        $parametro["id"] = $id;
        $result = $this->bd->setConsulta($sql, $parametro);
        if (!$result)
            return -1;
     return $this->bd->getNumeroFilas();
    }

    function desactivar($login) {
       $sql = 'update usuario 
           SET isactivo=0 
           WHERE login= :login';
       echo $sql;
        $parametro["login"] = $login;
        $result = $this->bd->setConsulta($sql, $parametro);
        if (!$result)
            return -1;
     return $this->bd->getNumeroFilas();
    }
    
      function editPreparedPK($asignacion, $condicion="1=1", $parametros) {
        $sql = "update $this->tabla SET $asignacion WHERE $condicion";
        echo $sql;
        $result = $this->bd->setConsulta($sql, $parametro);

        echo "<hr/> $result";

        if (!$result)
            return -1;
        return $this->bd->getNumeroFilas();
    }
    
     function editConsulta($asignacion, $condicion="1=1", $parametros=array()){
        $sql = "update $this->tabla SET $asignacion WHERE $condicion";
        echo $sql;
        $result = $this->bd->setConsulta($sql, $parametros);
        echo "<hr>".$result;
        if (!$result)
            return -1;
        return $this->bd->getNumeroFilas();
    }
    
    function editConClave(Usuario $objeto, $loginPK, $claveOld) {
       $asignacion=" login= :login, clave= :clave, nombre= :nombre, 
            apellido= :apellido, email= :email ";
       $condicion=" login= :loginPK AND clave=:claveOld;";
        
       $parametro["login"] = $objeto->getLogin();       //NUEVO LOGIN
        $parametro["clave"] = sha1($objeto->getClave());
        $parametro["nombre"] = $objeto->getNombre();
        $parametro["apellido"] = $objeto->getApellido();
        $parametro["email"] = $objeto->getEmail();
        $parametro["loginPK"] = $loginPK;  //VIEJO LOGIN DEL ORIGINAL
        $parametro["claveOld"] = sha1($claveOld);  //VIEJO LOGIN DEL ORIGINAL

         $result = $this->editConsulta($asignacion, $condicion, $parametro);

        if (!$result)
            return -1;
        return $this->bd->getNumeroFilas();
    }
    
   
    
     function editSinClave(Usuario $objeto, $loginPK) {
        $asignacion=" login= :login, nombre= :nombre, 
            apellido= :apellido, email= :email ";
        $condicion=" login= :loginPK;";
        
        $parametro["login"] = $objeto->getLogin();       //NUEVO LOGIN
        $parametro["nombre"] = $objeto->getNombre();
        $parametro["apellido"] = $objeto->getApellido();
        $parametro["email"] = $objeto->getEmail();
        $parametro["loginPK"] = $loginPK;  //VIEJO LOGIN DEL ORIGINAL

        $result = $this->editConsulta($asignacion, $condicion, $parametro);

        echo "<hr/> $result";

        if (!$result)
            return -1;
        return $this->bd->getNumeroFilas();
    }
    
     function cambiarClave($login, $id) {
        $sql = "select * from $this->tabla "
                . "where login=:login and md5(concat(login,'" . Configuracion::PEZARANA . "',email))=:id;";
        $parametros["login"] = $login;
        $parametros["id"] = $id;
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }
    
}
?>
