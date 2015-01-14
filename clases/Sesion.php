<?php

class Sesion {
    
    /**
     * contructor ->nombre
     * metodos:
     *      set (nombre, valor)
     *      add(nombre, valor)
     *      get(nombre)
     *      getNombre()  -->  devuelve un array con los nombre de sesion, despues con el get(nombre) podremos sacar su valor
     *      delete(nombre)
     *      delete()  --> te borra todas las variables de sesion
     *      isSesion() --> saber si se ha iniciado la sesion
     *      isAutentificado()
     *      getUsuario()
     *      setUsuario
     *      
     * ---------------por implementar
     * isAdministrador()
     * isAvanzado()
     * isUsuario
     * getRol()
     */
   private static $instancia; 
   
   private function __construct($nombre="") {   //al ser un constructor privado, solo lo podra llamar la clase y controlar q solo se haga el start una vez
       if($nombre!="")
           session_name ($nombre);
       
       
       session_start();
       //esto hace que para iniciar un objeto de la clase tendremos q llamar a $variable=Session::getSesion(..);
     }

     
     public static function getSesion($nombre=""){
         if(is_null(self::$instancia))
             self::$instancia=new self($nombre);
         
         return self::$instancia;
         
     }
     
     function cerrar(){
         session_unset();
         session_destroy();
     }
     
     
     public function set($nombre, $valor){
         $_SESSION[$nombre]=$valor;
     }
     
     
    public function get ($nombre){
         if(isset($_SESSION[$nombre]))
             return $_SESSION[$nombre];
         else
             return null;
     }
     
     
     public function getNombre(){
         $array=array();
         foreach ($_SESSION as $nombre =>$valor) {
             $array[]=$nombre;
         }
         return $array;
     }
     
     public function delete($nombre=""){
         if($nombre==="")
             unset($_SESSION);
         else{
             if(isset($_SESSION[$nombre]))
                 unset ($_SESSION[$nombre]);
         }
     }
     
     public function deleteAll(){
         foreach ($_SESSION as $nombre => $valor) {
             $_SESSION[$nombre]="";
         }
         
         //unset($_SESSION);
         //session_destroy();
     }
     
     
     private function redirigir($destino="index.php"){
         header("Location: ".$destino);
         exit;
     }
     
     
     public function destroy(){
         session_destroy();
     }
     
     public function isSesion(){
         if(count($_SESSION)>0)
             return true;
        
       return false; 
     }
     
     public function isAutentificado(){
         return isset($_SESSION["__usuario"]);
     }
     
     public function getUsuario(){
         return $_SESSION["usuario"];
     }
     
     public function setUsuario($valor){
         $_SESSION["usuario"]=$valor;
     }
     
}
?>

