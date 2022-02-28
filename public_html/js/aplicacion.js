

/**
 * 
 * MODEL .PHP
 * REQ : COLUMNAS_REQUERIDAS, NOMBRE_TABLA, COLUMNAS_VALORES, FECHA_ELIMINADO
 * 
 */
var tabla;

let form =[];
var validarIsNumber = /^[0-9]+$/;
const url = window.location.href
var object = {};



function init(){
    mostrarDatosModelo(true);
}
function getDate(){
    var d = new Date();
    return d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();

}



$("form").on("submit",function(e){

    e.preventDefault();
    funcion = $(this).attr('funcion')
    tabla = $(this).attr('tabla')
    accion = $(this).attr('accion')
    id = $(this).attr("id")
    
    formdata = new FormData($(this)[0])
    formdata.forEach((value, key) => {object[key] = value})
    request = {
        "nombre_tabla":tabla,
        "columnas_valores":object,
        "id":id
    }
    enviarParaFuncion(url+funcion,request,false,accion)
    mostrarDatosModelo(true)
    $(this).trigger("reset")
})

function alertaPost(response,accion){
    if(response){
        bootbox.alert({
            title:accion+" el Registro",
            closeButton:false,
            message:"Si se pudo "+ accion + " el Registro de la base de datos :)"
        })
    }else{
        bootbox.alert({
            title: "Error al "+accion+" el Registro",
            closeButton:false,
            message:"No se pudo "+accion + " el Registro de la base de datos :("
        })
    }
}

function enviarParaFuncion(url,request,datostabla,accion){
    
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
            //console.log(response);
            if(response == 1 || response == 0){
                if (response == 0) {
                    response = false
                }else{
                    response = true
                }
                alertaPost(response,accion);
            }else{
                tabla = $("form").attr('tabla')
                funcion = "/setDataUpdate"
                accion = "Actualizar"
                modelo = JSON.parse(response)
                formArray(modelo,funcion,accion,tabla)
            }
            
        })    
    }
}


function formArray(object,funcion,accion,tabla){
    for (const key in object) {
        if(!key.match(validarIsNumber)){
            
            $("input[name="+key+"]").val(object[key])
        }   
    }
    key = tabla+"_id"
    if(!object[key] == ""){
        $("form").attr("id",object[key])
    }
    $("form").attr("funcion",funcion)
    $("form").attr('accion',accion)
    
}

function mostrarDatosModelo(activador){
    tabla = $("table").attr('tabla')
    funcion = $("table").attr('funcion')    
    activador ? enviarParaFuncion(url+funcion,{"nombre_tabla":tabla,"columnas_requeridas":null},true,"Seleccionar"):$("table").hide()   
}

function darDatos(activador,funcion,pk){
    tabla = $("form").attr("tabla")
    if (activador) {
        //mostrar un mensaje de confirmacion
        bootbox.confirm(
            {
                title:"Editar este registro?",
                closeButton:false,
                message:"Estas seguro de seguir para ver el registro para su edicion?, cierre si no es el caso",
                callback: (confirm)=>{
                    if (confirm) {
                        enviarParaFuncion(url+funcion+pk,{"nombre_tabla":tabla,"columnas_requeridas":null,"id":pk},false,"Seleccionar")                        
                        
                    }            
                }   
            })
        
    }
}

function eliminarDato(activador,funcion,pk){
    tabla = $("form").attr("tabla")
    if (activador) {
        //mostrar un mensaje de confirmacion
        bootbox.confirm(
            {
                title:"Eliminar este registro?",
                closeButton:false,
                message:"Estas seguro de seguir para eliminar el registro para su suspension?, cierre si no es el caso",
                callback: (confirm)=>{
                    if (confirm) {
                        enviarParaFuncion(url+funcion,{"nombre_tabla":tabla,"fecha_eliminado":getDate(),"columnas_requeridas":null,"id":pk},false,"Remover")
                        mostrarDatosModelo(true)                        
                    }            
                }   
            })  
    }
}

init()