

/**
 * 
 * MODEL .PHP
 * REQ : COLUMNAS_REQUERIDAS, NOMBRE_TABLA, COLUMNAS_VALORES, FECHA_ELIMINADO
 * NO MOVER NINGUN DE ESTOS SOLOPOR FINES PRACTICAS Y EMJORAS DE CODIGO SI, PERO PARA PRDOUCCCION ES MEJOR NO TOCAR :)
 */
var tabla;

let form =[];
var expresionRegular = /^[0-9]+$/;
const url = window.location.href
var object = {};


function init(){
    seeDataModel(true);

}
function getDate(){
    var d = new Date();
    return d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();

}

$("form").on("submit",function(e){

    e.preventDefault();
    accion = $(this).attr('accion')
    //no se que hace si guardar o editar...
    bootbox.confirm(
        {
                title:accion+" este registro?",
                closeButton:false,
                message:"Estas seguro de seguir para "+accion+" el registro?, cierre si no es el caso",
                callback: (confirm)=>{      
                    if (confirm) {            
                    funcion = $(this).attr('funcion')
                    tabla = $(this).attr('tabla')
                    id = $(this).attr("id")
                    formdata = new FormData($(this)[0])
                    formdata.forEach((value, key) => {object[key] = value})
                    request = {
                        "nombre_tabla":tabla,
                        "columnas_valores":object,
                        "id":id
                    }
                    sendForFunction(url+funcion,request,false,accion)
                    seeDataModel(true)
                    $(this).trigger("reset")
                    $("#submit").html("Agregar")
            }
                    
        }   
    })
})

function alertBootBoxResponse(response,accion){
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

function confirmBootBoxRequest(response) {
    if(response){
        bootbox.confirm(
            {
                title:"Guarar este registro?",
                closeButton:false,
                message:"Estas seguro de seguir para guardar el registro?, cierre si no es el caso",
                callback: (confirm)=>{
                    if (confirm) {
                        return true;
                    }            
                }   
            })
    }
}


function sendForFunction(url,request,datostabla,accion){
    
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
                alertBootBoxResponse(response,accion);
            }else{
                tabla = $("form").attr('tabla')
                funcion = "/setDataUpdate"
                accion = "Actualizar"
                modelo = JSON.parse(response)
                setFormArrayResponse(modelo,funcion,accion,tabla)
            }
        }).fail(function(e){
            console.log(e.responseText);
        })    
    }
}


function setFormArrayResponse(object,funcion,accion,tabla){
    for (const key in object) {
        if(!key.match(expresionRegular)){
            
            $("input[name="+key+"]").val(object[key])
        }   
    }
    key = tabla+"_id"
    if(!object[key] == ""){
    }
        $("form").attr("id",object[key])

    $("form").attr("funcion",funcion)
    $("form").attr('accion',accion)
    $("#submit").html(accion)
}

function seeDataModel(activador){
    tabla = $("table").attr('tabla')
    funcion = $("table").attr('funcion')    
    activador ? sendForFunction(url+funcion,{"nombre_tabla":tabla,"columnas_requeridas":null},true,"Seleccionar"):$("table").hide()   
}
//fcuinciones de onclick button
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
                        sendForFunction(url+funcion+pk,{"nombre_tabla":tabla,"columnas_requeridas":null,"id":pk},false,"Seleccionar")                        
                        
                    }            
                }   
            })
        
    }
}
//funcinesdesde onclik boton
function eliminarDato(activador,funcion,pk){
    formattr = $("form").attr("tabla")
    tablaattr = $("table").attr("tabla")
    if(formattr == tablaattr){
        tabla = formattr;
    }else{
        tabla = tablaattr;
    }
    if (activador) {
        //mostrar un mensaje de confirmacion
        bootbox.confirm(
            {
                title:"Eliminar este registro?",
                closeButton:false,
                message:"Estas seguro de seguir para eliminar el registro para su suspension?, cierre si no es el caso",
                callback: (confirm)=>{
                    if (confirm) {
                        sendForFunction(url+funcion,{"nombre_tabla":tabla,"fecha_eliminado":getDate(),"columnas_requeridas":null,"id":pk},false,"Remover")
                        seeDataModel(true)                        
                    }            
                }   
            })  
    }
}

init()