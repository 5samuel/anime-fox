var buscador = $("#table").DataTable();// referencia al input del buscador.

$("#input-search").keyup(function(){
    
    buscador.search($(this).val()).draw(); // busquedad en tiempo real.
    
    if ($("#input-search").val() == ""){
        $(".content-search").fadeOut(300);// ocultar las obciones que no busca.
    }else{
        $(".content-search").fadeIn(300); // dejar las busquedad que funcionen.
    }
})