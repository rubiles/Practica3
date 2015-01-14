<?php


class NOTAS {

    
    /*
     * 
     *  NORMAS DE ESTRUCTURA
     * 
     *          INDEX.PHP
     *                  CLASES
     *                  JS
     *                    main.js
     *                  CSS
                         style.css
     *                  IMG
     *                  INCLUIR
     *                  REQUIRE
     *                  ....
     * 
     * 
     * 
     * TABLAS DE LA BD              CLASE DE LA TABLA       INPUT NAME      --> USAMOS LOS MISMO NOMBRE
     * campo1                       campo1                      name="campo1"
     * campo2                       campo2                      name="campo2"
     * 
     * 
     * 
     * Enlaces relativos -> si muevo la carpeta a otro servidor, tiene q seguir todo funcionando.
     * 
     * En las clases los ECHO estan completamente prohibido, las clases solo
     *  hacen calculos o lo q sea y devuelven valores.
     * 
     * Los phpInsert, phpDelete etc nunca escriben nada.
     *
     * Los archibos de visualizacion (index.php, etc) tenemos que reducir el codigo php
     * lo mas que se pueda. De forma q parezca enteramente una pagina web HTML.
     * 
     * 
     * 
     * PRACTICA LOGIN
     * 
     * -TABLA USUARIOS
     *      login varchar(30)          not null
     *      clave varchar (40)        not null
     *      nombre varchar(30)        not null
     *      apellido varchar(60)      not null
     *      email    varchar(40)      not null
     *      fechaAlta   datetime      not null
     *      fechaLogin  datetime      
     *      isActivo    tinyInt(1)    not null  default=0
     *      isRoot      tiniInt(1)    not null  default=0
     *      rol         enum("Administrador", "")    not null default="usuario"
     *      
     *      
     * 
     * implementa la clase usuarios.php y modelousuario.php
     create table usuario(
        login varchar(30) not null primary key,
        clave varchar(40) not null,
        nombre varchar(30) not null,
        apellido varchar(60) not null,
        email varchar(40) not null,
        fechaalta date not null,
        isactivo tinyint(1) not null default 0,
        isroot tinyint(1) not null default 0,
        rol enum('administrador', 'usuario') not null default 'usuario',
        fechalogin datetime
    ) engine=innodb charset=utf8 collate=utf8_unicode_ci;
       
        
     */
  
}
?>
