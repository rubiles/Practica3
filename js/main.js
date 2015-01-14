window.onload=inicio;

function inicio(){
    
     var borrar=document.getElementsByClassName('borrar');
     for(var i=0; i<borrar.length; i++)
     {
            borrar[i].addEventListener("click","confirmar");
     }
    
    var editar=document.getElementsByClassName('editar');
     for(var i=0; i<editar.length; i++)
     {
            editar[i].addEventListener("click", "modificar");
     }
}

function confirmar(e){
    var nombre=this.getAttibute("data-nombre");
    //var respuesta=confirm("Seguro que quieres borrar a "+nombre);
    if(!confirm("Seguro que quieres borrar a "+nombre))
        e.preventDefault();
}


/*en vez de usar get por el enlace, lo oculto en un formulario oculto y lanzo el formulario*/
function modificar(e){
    e.preventDefault();
    var id=this.getAttibute("data-id");
    var f=document.getElementById("formulario");
    var idf=document.getElementById("idformulario");
    idf.value=id;
    f.action("ver.php");
    f.submit();
   
    
    
}