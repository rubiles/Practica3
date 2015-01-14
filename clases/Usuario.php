<?php


class Usuario {
    
    
    private $login;
    private $clave;
    private $nombre;
    private $apellido;
    private $email;
    private $fechaalta;
    private $isactivo;
    private $isroot;
    private $rol;
    private $fechalogin;
    
    /*EL ORDEN DE LA VARIABLES DE INSTANCIA TIENEN Q SER CON EL MISMO ORDEN Q EN LA BD Y CON VALOR PREDET NULL*/
    function __construct($login=null, $clave=null, $nombre=null, $apellido=null, $email=null, 
            $fechaalta=null, $isactivo=0, $isroot=0, $rol="usuario", $fechalogin=null){
        
        $this->login=$login;
        $this->clave=$clave;
        $this->nombre=$nombre;
        $this->apellido=$apellido;       
        $this->email=$email;
        $this->fechaalta=$fechaalta;
        $this->isactivo=$isactivo;
        $this->isroot=$isroot;
        $this->rol=$rol;
        $this->fechalogin=$fechalogin;
        
        
    }

    function set($datos, $inicio=0){    //ME LLEGA UN ARRAY DE DATOS, Y UNA POSICION INICIAL
        //devolvera desde el valor q le hemos en inicio dado palante
        $this->login=$datos[0+$inicio];
        $this->clave=$datos[1+$inicio];
        $this->nombre=$datos[2+$inicio];
        $this->apellido=$datos[3+$inicio];       
        $this->email=$datos[4+$inicio];
        $this->fechaalta=$datos[5+$inicio];
        $this->isactivo=$datos[6+$inicio];
        $this->isroot=$datos[7+$inicio];
        $this->rol=$datos[8+$inicio];
        $this->fechalogin=$datos[9+$inicio];
    }
    
    public function getLogin() {
        return $this->login;
    }

    public function getClave() {
        return $this->clave;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getFechaalta() {
        return $this->fechaalta;
    }

    public function getIsactivo() {
        return $this->isactivo;
    }

    public function getIsroot() {
        return $this->isroot;
    }

    public function getRol() {
        return $this->rol;
    }

    public function getFechalogin() {
        return $this->fechalogin;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setClave($clave) {
        $this->clave = $clave;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setFechaalta($fechaalta) {
        $this->fechaalta = $fechaalta;
    }

    public function setIsactivo($isactivo) {
        $this->isactivo = $isactivo;
    }

    public function setIsroot($isroot) {
        $this->isroot = $isroot;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }

    public function setFechalogin($fechalogin) {
        $this->fechalogin = $fechalogin;
    }



    
     
    public function getJSON(){
        $prop=  get_object_vars($this);     //me da toda las variables de instancia de esta clase (isactivo, isroot, rol, etc etc etc )
        $resp="{ ";
        foreach ($prop as $key => $value) {
            $resp.='"'.$key.'":'.json_encode(htmlspecialchars_decode($value)).',';   //meto todas las variables en un obj JSON 
        }
        $resp=substr($resp, 0,-1)."}";  //le quito la ultima coma y cierro la llave
     return $resp;   
    }
}

?>
