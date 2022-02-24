
/**
 * 
 * MODEL .PHP
 * REQ : COLUMNAS_REQUERIDAS, NOMBRE_TABLA, COLUMNAS_VALORES, FECHA_ELIMINADO
 * 
 */
var tabla;
const url = window.location.href
var object = {};


mostrarDatosModelo(true);



$("form").on("submit",function(e){

    e.preventDefault();
    funcion = $(this).attr('funcion')
    tabla = $(this).attr('tabla')
    formdata = new FormData($(this)[0])
    formdata.forEach((value, key) => {object[key] = value})
    request = {
        "nombre_tabla":tabla,
        "columnas_valores":object,
    }
    enviarParaFuncion(url+funcion,request,false)
    mostrarDatosModelo(true)

})

function enviarParaFuncion(url,request,datostabla){
    
    if (datostabla) {
        tabla = $("#tbllistado").dataTable(
            {
                "aProcessing": true,
                "aServerSide": true,
                dom: "Bfrtip",
                buttons: [
                    
                ],
                "ajax":
                    {
                        data:request,
                        url:url,
                        type: "POST",
                        dataType:"json",
                        error:function(e) {
                            console.log(e.responseText);
                        }
                    },
                "bDestroy": true,
                "iDisplayLength":5 ,
                "order":[[ 0 , "desc" ]]
        }).DataTable();        
    }else{
        $.post(url,request,function(response){
            console.log(response)
        })    
    }

}


function mostrarDatosModelo(activador){
    tabla = $("table").attr('tabla')
    funcion = $("table").attr('funcion')
    activador ? enviarParaFuncion(url+funcion,{"nombre_tabla":tabla,"columnas_requeridas":null},true):$("table").hide()   
}
