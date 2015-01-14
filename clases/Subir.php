<?php

class Subir{

    private $files, $input, $destino, $nombre, $accion, $maximo, $tipos, $extensiones,$crearCarpeta;
    private $errorPHP, $error;
    private $errorMultiple;
    
    const IGNORAR = 0, RENOMBRAR = 1, REEMPLAZAR = 2;
    const ERROR_INPUT = -1;

    function __construct($input) {
        $this->input = $input;
        $this->destino = "./";
        $this->nombre = "";
        $this->accion = SubirCarmelo::RENOMBRAR;      //la crea sin mas, exista o no otra =
        $this->maximo = 2 * 1014 * 1024;            //2MB por defecto
        $this->crearCarpeta = false;
        $this->tipos = array();
        $this->extensiones = array();
        $this->errorPHP = UPLOAD_ERR_OK;
        $this->error = 0;
        $this->errorMultiple=array();
    }//
    
  
    
    function getErrorPHP() {
        return $this->errorPHP;
    }//

    public function getTipos() {
        return $this->tipos;
    }

        function getError() {
        return $this->error;
    }//

    function getMensajeError(){
        return $this->error;
    }
    
    function setCrearCarpeta($crearCarpeta) {       //booleano
        $this->crearCarpeta = $crearCarpeta;
    }

    function setDestino($destino) {
        $caracter = substr($destino, -1);
        if ($caracter != "/")
            $destino.="/";
        $this->destino = $destino;
    }//

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }//

    function setAccion($accion) {
        $this->accion = $accion;
    }//

    function setMaximo($maximo) {
        $this->maximo = $maximo;
    }//

    function addTipo($tipo) {
        if (is_array($tipo)) {
            $this->tipos = array_merge($this->tipos, $tipo);
        } else {
            $this->tipos[] = $tipo;
        }
    }//

    function setExtension($extension) {
        if (is_array($extension)) {
            $this->extensiones = $extension;
        } else {
            unset($this->extensiones);
            $this->extensiones[] = $extension;
        }
    }//
    
    function addExtension($extension) {
        if (is_array($extension)) {
            $this->extensiones = array_merge($this->extensiones, $extension);
        } else {
            $this->extensiones[] = $extension;
        }
    }//

    function isInput(){
        if (!isset($_FILES[$this->input])) {
            $this->error = -1;
            return false;
        }
        return true;
    }//
    
    private function isError(){
        if ($this->errorPHP != UPLOAD_ERR_OK) {
            return true;
        }
        return false;
    }//
    
    private function isTamano(){
        if ($this->files["size"] > $this->maximo) {
            $this->error = -2;
            return false;
        }
        return true;
    }//

    private function isExtension($extension){
        if (sizeof($this->extensiones) > 0 && !in_array($extension, $this->extensiones)) {
            $this->error = -3;
            return false;
        }
        return true;
    }//
    
    private function isCarpeta(){
        if (!file_exists($this->destino) && !is_dir($this->destino)) {
            $this->error = -4;
            return false;
        }
        return true;
    }//
    
    private function crearCarpeta() {  
        return mkdir ( $this->destino , Configuracion::MASCARA_PERMISOS, true);      
    }
            
  
    
 /* SUBIR MULTIPLE
  * **************************************************************************************************
  */   
    function isErrorMultiple(){
        for ($i = 0; $i < count($this->files['name']); $i++) {
            $this->errorPHP = $this->files["error"][$i];
            if($this->isError())
                return true;
        }
        return false;
    }
    
    function getMensajeMultiple(){
        $cad_error="";
        foreach ($this->errorMultiple as $key =>$value) {
            $cad_error.=$value;
        }
        return $cad_error;
    }
    
    function setMensajeMultiple($error){
        $this->errorMultiple[]=$error."<br/>";
    }
    
    function isTamanoMultiple(){
        for ($i = 0; $i < count($this->files['name']); $i++) {
          if ($this->files["size"][$i] > $this->maximo) {
             $this->error = -2;
             $this->setMensajeMultiple("El archivo:".$this->files['name'][$i]." ha sobrexcedido el tamaño soportado");
              return false;
           }
        }
        return true;
        
    }
        
    function subirMultiple() {
        //$this->error = 0;
        
        //SI NO METEMOS NADA, PAFUERA
        if(!$this->isInput()){
            $this->setMensajeMultiple("No ha llegado ningun input file");
            return false;
        }
        
        //EN $THIS->FILES ESTÁ TODA LA RUTA METIDA, YA SEA 1 ARCHIVO O 1000
       $this->files=array();
       $this->files = $_FILES[$this->input];
       
        //control de errores archivo a archivo
        if($this->isErrorMultiple()){
            $this->setMensajeMultiple("Los archivos viajan con errores");
            return false;
        }
        
        //control de tamaño archivo a archivo
        if(!$this->isTamanoMultiple()){
             $this->setMensajeMultiple("Se ha sobrexcedido el tamaño de archivos");
            return false;
        }
        
        if(!$this->isCarpeta()){
            if($this->crearCarpeta){
                $this->error=0;//
                if(!$this->crearCarpeta()){
                    //$this->error=-7;
                     $this->setMensajeMultiple("No se ha podido crear la carpeta");
                    return false;
                }       
            } else{
                return false;
            }
        }
       
        
 /***SUBIR ARCHIVO A ARCHIVO****/ 
 //  for ($i = 0; $i < count($this->files['name']); $i++) 
   
   foreach($this->files['name'] as $i => $value)     
   { 
        //$this->error = 0;
        $partes = pathinfo($this->files["name"][$i]);
        $extension = $partes['extension'];
        $nombreOriginal = $partes['filename'];
  //reviso extensiones 
        if(!$this->isExtension($extension)){
             $this->setMensajeMultiple("Error de Extension en archivo ".$this->files["name"][$i]);
        }
        else{
            //reviso si hay que cambiarle el nombre    
             if ($this->nombre === "") {
                 $this->nombre = $nombreOriginal;
            }
            //recojo origen y destino del $_FILES con $this->files     
            $origen = $this->files["tmp_name"][$i];
            $destino = $this->destino . $this->nombre . "." . $extension;
            //reviso condiciones de subida   
                 if ($this->accion === SubirCarmelo::REEMPLAZAR) {
                      if(move_uploaded_file($origen, $destino))
                          $this->setMensajeMultiple("Archivo: ". $this->files["name"][$i]." subido con exito");    
                 }  elseif ($this->accion === SubirCarmelo::RENOMBRAR) {
                     $i = 1;
                     while (file_exists($destino)) {
                         $destino = $destino = $this->destino . $this->nombre . "_$i." . $extension;
                         $i++;
                     }
                      if(move_uploaded_file($origen, $destino))
                          $this->setMensajeMultiple("Archivo: ". $this->files["name"][$i]." subido con exito");    
                 }elseif ($this->accion === SubirCarmelo::IGNORAR) {
                        if (file_exists($destino)) {
                             $this->error = -5;
                             // return false;
                        }else
                          if(move_uploaded_file($origen, $destino))
                          $this->setMensajeMultiple("Archivo: ". $this->files["name"][$i]." subido con exito");    
                 }
              
             }
   }
 }

  /*function subir() {
        $this->error = 0;
        
        //SI NO METEMOS NADA, PAFUERA
        if(!$this->isInput()){
            return false;
        }
        
        //EN $THIS->FILES ESTÁ TODA LA RUTA METIDA, YA SEA 1 ARCHIVO O 1000
        $this->files = $_FILES[$this->input];
        $this->errorPHP = $this->files["error"];
        if($this->isError()){
            return false;
        }
        if(!$this->isTamano()){
            return false;
        }
        if(!$this->isCarpeta()){
            if($this->crearCarpeta){
                $this->error=0;//
                if(!$this->crearCarpeta()){
                    $this->error=-7;
                    return false;
                }       
            } else{
                return false;
            }
        }
       
        $partes = pathinfo($this->files["name"]);
        $extension = $partes['extension'];
        $nombreOriginal = $partes['filename'];
  //reviso extensiones 
        if(!$this->isExtension($extension)){
            return false;
        }
   //reviso si hay que cambiarle el nombre    
        if ($this->nombre === "") {
            $this->nombre = $nombreOriginal;
        }
   //recojo origen y destino del $_FILES con $this->files     
        $origen = $this->files["tmp_name"];
        $destino = $this->destino . $this->nombre . "." . $extension;
   //reviso condiciones de subida   
        if ($this->accion === SubirCarmelo::REEMPLAZAR) {
            return move_uploaded_file($origen, $destino);
        }  elseif ($this->accion === SubirCarmelo::RENOMBRAR) {
            $i = 1;
            while (file_exists($destino)) {
                $destino = $destino = $this->destino . $this->nombre . "_$i." . $extension;
                $i++;
            }
            return move_uploaded_file($origen, $destino);
        }elseif ($this->accion === SubirCarmelo::IGNORAR) {
            if (file_exists($destino)) {
                $this->error = -5;
                return false;
            }
            return move_uploaded_file($origen, $destino);
        }
        $this->error = -6;
        return false;
    }
*/
function subir() {
        $this->error = 0;
        
        //SI NO METEMOS NADA, PAFUERA
        if(!$this->isInput()){
            return false;
        }
        
        //EN $THIS->FILES ESTÁ TODA LA RUTA METIDA, YA SEA 1 ARCHIVO O 1000
        $this->files = $_FILES[$this->input];
        $this->errorPHP = $this->files["error"];
        if($this->isError()){
            return false;
        }
        if(!$this->isTamano()){
            return false;
        }
        if(!$this->isCarpeta()){
            if($this->crearCarpeta){
                $this->error=0;//
                if(!$this->crearCarpeta()){
                    $this->error=-7;
                    return false;
                }       
            } else{
                return false;
            }
        }
       
        $partes = pathinfo($this->files["name"]);
        $extension = $partes['extension'];
        $nombreOriginal = $partes['filename'];
  //reviso extensiones 
        if(!$this->isExtension($extension)){
            return false;
        }
   //reviso si hay que cambiarle el nombre    
        if ($this->nombre === "") {
            $this->nombre = $nombreOriginal;
        }
   //recojo origen y destino del $_FILES con $this->files     
        $origen = $this->files["tmp_name"];
        $destino = $this->destino . $this->nombre . "." . $extension;
   //reviso condiciones de subida   
        if ($this->accion === SubirCarmelo::REEMPLAZAR) {
            return move_uploaded_file($origen, $destino);
        }  elseif ($this->accion === SubirCarmelo::RENOMBRAR) {
            $i = 1;
            while (file_exists($destino)) {
                $destino = $destino = $this->destino . $this->nombre . "_$i." . $extension;
                $i++;
            }
            return move_uploaded_file($origen, $destino);
        }elseif ($this->accion === SubirCarmelo::IGNORAR) {
            if (file_exists($destino)) {
                $this->error = -5;
                return false;
            }
            return move_uploaded_file($origen, $destino);
        }
        $this->error = -6;
        return false;
    }
}