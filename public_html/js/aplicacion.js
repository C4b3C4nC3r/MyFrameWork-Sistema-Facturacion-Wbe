

/**
 * 
 * MODEL .PHP
 * REQ : COLUMNAS_REQUERIDAS, NOMBRE_TABLA, COLUMNAS_VALORES, FECHA_ELIMINADO
 * NO MOVER NINGUN DE ESTOS SOLOPOR FINES PRACTICAS Y EMJORAS DE CODIGO SI, PERO PARA PRDOUCCCION ES MEJOR NO TOCAR :)
 */
var tabla;

let form =[];
var expresionRegular = /^[0-9]+$/;
const url = window.location.href //casos estaticos
var object = {};
//aqui pondras lo inpust que no quieres que vayan al post
const removeFormData = [
    "iva_porcentaje",
    "buscar_tabla_id",
    "descuento_porcentaje",
    "kf_cliente"
]


const tableLoadForever=[
    "temporal"
]

function init(){
    seeDataModel(true);
    whenTemporalExist();
}
function getDate(){
    var d = new Date();
    return d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();

}

$("form").on("submit",function(e){
    object = {};
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
                        formdata.forEach((value, key) => {        
                            if(!removeFormData.includes(key)){
                                object[key] = value
                                //console.log(key);
                            }
                            
                        })
                        
                    request = {
                        "nombre_tabla":tabla,
                        "columnas_valores":object,
                        "id":id
                    }
                    //console.log(request);
                    //console.log(funcion);
                    sendForFunction(funcion,request,false,accion)
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
            //alertBootBoxResponse(response,accion);
            casesResponse(response,accion)
            
        }).fail(function(e){
            console.log(e.responseText);
        })    
    }
    //funciones de poster
    whenTemporalExist()
}


function setFormArrayResponse(object,funcion,accion,tabla){
    for (const key in object) {
        if(!key.match(expresionRegular)){
            
            $("input[name="+key+"]").val(object[key])
        }   
    }
    key = tabla+"_id"
    //if(!object[key] == ""){
    
    //}
    $("form").attr("id",object[key])

    $("form").attr("funcion",funcion)
    $("form").attr('accion',accion)
    $("#submit").html(accion)
}

function seeDataModel(activador){
    tabla = $("table").attr('tabla')
    funcion = $("table").attr('funcion')    
    columnas_requeridas = $("table").attr("col") == null ? null : $("table").attr("col")
    activador ? sendForFunction(url+funcion,{"nombre_tabla":tabla,"columnas_requeridas":columnas_requeridas},true,"Seleccionar"):$("table").hide()   
    tabla = null
    funcion =null
    columnas_requeridas = null
}


//mejorar la funcion uwu
//fcuinciones de onclick button
function darDatos(activador,funcion,pk){
    tabla = $("form").attr("tabla")
    //console.log(funcion);
    //console.log(tabla);
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

//funcinesdesde onclik boton
function cambiarEstado(activador,funcion,pk){
    formattr = $("form").attr("tabla")
    tablaattr = $("table").attr("tabla")
    if(formattr == tablaattr){
        tabla = formattr;
    }else{
        tabla = tablaattr;
    }
    if (activador) {
        colvalue = {}
        action = "No Definida"
        //mostrar un mensaje de confirmacion
        bootbox.confirm(
            {
                title:"Cambiar Estado?",
                closeButton:false,
                message:"Estas seguro de cambiar de estado este registro?, cierre si no es el caso",
                callback: (confirm)=>{
                    if (confirm) {


                        funcion = String(funcion).replace("/","")
                        request = null
                        //casos
                        
                        switch (funcion) {
                            case "trash/":
                                request ={"id":pk,"fecha_eliminado":getDate(),"nombre_tabla":tabla}
                                action = "Suspender"
                                break;
                            case "untrash/":
                                request ={"id":pk,"nombre_tabla":tabla}                                
                                action = "Reactivar"
                                break;
                        
                            default:
                                break;
                        }
                        sendForFunction(url+funcion,request,false,action)                        
                        seeDataModel(true)
                    }            
                }   
            })  
    }
}


function mostrarDatos(activador,funcion,pk) {
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
                title:"Revisar el Contenido?",
                closeButton:false,
                message:"Estas seguro de seguir para vizualizar el registro?, cierre si no es el caso",
                callback: (confirm)=>{
                    if (confirm) {
                        //String(funcion).replace("/","")
                        funcion = String(funcion).replace("/","")
                                                    //dar un datatable
                            $("#tabladetallemodal").dataTable(
                                {
                                    "aProcessing": true,
                                    "aServerSide": true,
                                    dom: "Bfrtip",
                                    buttons: [
                                        
                                    ],
                                    "ajax":
                                        {
                                            data:{"kf_factura_id":pk},
                                            url:url+funcion,
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

                            var MyModal = new bootstrap.Modal(document.getElementById("tabladetalle"),{
                                keyboard: false
                              }
                            )
                            MyModal.show()
                        } 
                }   
            })  
    }
}

function editarRegistros (activador,funcion,pk){
    //print
    console.log("Indicar que cantidad de producto se devolvio?");
}
/**
 * 
 * FUNCIONES DE DESARROLLADOR :)
 * 
 */

function traerSubtotal(){
    let funcion = $("#factura_subtotal").attr("funcion");
    let subtotal_det = []
    let dir = url + funcion;
    let subtotal = 0;

    $.post(dir,{},(resp)=>{
    
        subtotal_det = JSON.parse(resp)
    
        subtotal_det.forEach(element => {
            //console.log(element);
            subtotal = subtotal+parseFloat(element)
        });
        $("#factura_subtotal").val(subtotal);
    
        //suma de todos
    })
}


//console.log(tableLoadForever);

//temporalmente :g
//traerSubtotal();

function whenTemporalExist(){
    let getTabla = $("table").attr("tabla");

    if(tableLoadForever.includes(getTabla)){
        
        //siempre caragara las funciones necesarias...
        switch (getTabla) {
            case "temporal":
                traerSubtotal();    
            break;
            default:
                bootbox.alert(getTabla)
            break;
        }
        
    }
}


function advertir(ruta){

    bootbox.confirm({
        title:"Salir de tu Cuenta",
        message:"Estas seguro de salir de tu cuenta?",
        closeButton:false,
        callback:(confirm)=>{
            if(confirm){
                $(".response").show();
                setTimeout (()=>{
                    window.location= ruta;
                },2000)
                
            }
        }
    })
}


function casesResponse(response,accion){
    //console.log(typeof(response));
    //console.log(response);
    response = JSON.parse(response);
    
    switch (response) {
        case 0:
            response = false
            alertBootBoxResponse(response,accion);
            break;
        case 1:
            response = true
            alertBootBoxResponse(response,accion);
            break;
        case 2:
            $("#form").hide();
            $(".response").show();
            setTimeout (()=>{
                window.location="/home";
            },2000);
            break;
        
        default:
            tabla = $("form").attr('tabla')
            funcion = "/setDataUpdate"
            accion = "Actualizar"
            modelo = response
            setFormArrayResponse(modelo,url+funcion,accion,tabla)
            break;

        
        
    }
}

init()