  /* -TABLA USUARIOS
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
*/
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
       
