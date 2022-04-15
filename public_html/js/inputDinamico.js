/**
 * 
 * USO PARA EL USUSARIO O DEV
 * 
 */
let id = $("#buscar_tabla_id").attr("buscar_tabla_id")
$(".response").hide()


//creacion d eobejtos y ruta
function busqueda(inputB,tablaB,funcion,columna,id_response,columnas_requeridas,input) {
    dir = url+funcion
    object = {
        "busqueda":inputB,
        "nombre_tabla":tablaB,
        "por_columna":columna,
        "columnas_requeridas":columnas_requeridas
    }
    //console.log(object);
    getDataForInput(dir,object,id_response,input)

}

//bsuqueda e impresion

function getDataForInput(dir,object,id_response,input) {
    //console.log(dir);
    $.post(dir,object,function(response) {
        //console.log(response);
        imprimirLista(response,id_response,input)
    }).fail(function(error){
        alert(error.responseText())
    })
}


    //keydown keypress la mejor forma es con keyup
$("#buscar_tabla_id").on("keyup",function(e){
    let inputB = $("#buscar_tabla_id").val()
    let funcion = $("#buscar_tabla_id").attr("funcion")
    let ta = $("#temporal_tabla_name").val()
    let columna = $("#buscar_tabla_id").attr("columna")
    let id_response = $("#buscar_tabla_id").attr("idresponse")
    let columnas_requeridas ="`product_id`,`product_name`,`product_price`";
    let input = "producto"
    busqueda(inputB,ta,funcion,columna,id_response,columnas_requeridas,input)

})
//buscador para cliente
$("#kf_cliente").on("keyup",function(e){
    let inputB = $("#kf_cliente").val()
    let funcion = $("#kf_cliente").attr("funcion")
    let ta = "cliente"
    let columna = $("#kf_cliente").attr("columna")
    let id_response = $("#kf_cliente").attr("idresponse")
    let input = "cliente";
    //console.log();  
    
    busqueda(inputB,ta,funcion,columna,id_response,"*",input)

})
$("#iva_porcentaje").on("change",()=>{
    getDescuento()
    getIva()
})
function getIva(){
    //luego se renderiza el iva
    let iva_porcentaje = $("#iva_porcentaje").val();
    let factura_subtotal = $("#factura_subtotal").val();
    //primero se hace el descuento..
    if($("#factura_descuento").val() != 0){
        factura_subtotal = factura_subtotal - $("#factura_descuento").val()
    }
    let iva = parseFloat(factura_subtotal)*parseFloat(iva_porcentaje)/100;
    let total = parseFloat(factura_subtotal)+parseFloat(iva);
    //a*b/100
    $("#factura_iva").val(redondearDecimal(iva))
    $("#factura_total").val(total.toFixed(2));

}
$("#descuento_porcentaje").on("change",()=>{
    getDescuento()
    getIva()
})

function redondearDecimal(number){
    return Math.round((number + Number.EPSILON) * 100) / 100
}

function getDescuento(){
    let descuento_porcentaje = $("#descuento_porcentaje").val();
    let factura_subtotal = $("#factura_subtotal").val();
    let descuento = parseFloat(factura_subtotal)*parseFloat(descuento_porcentaje)/100;
    let total = parseFloat(factura_subtotal)-parseFloat(descuento);
    //a*b/100
    $("#factura_descuento").val(redondearDecimal(descuento))
    $("#factura_total").val(total.toFixed(2));
    //despues de descuento va el iva

}

//imprirmir en un div
function imprimirLista(respuesta,id_response,input){
    //console.log(respuesta);
    let template = "" 
    resultado = JSON.parse(respuesta);
    if(resultado.length == 0){
    
        template=                `
        <li class="list-group-item">No se ha encontrado ese Registro...</li>
        `
    }else{
        
        resultado.forEach(element => {
            template+=
            `
                <li class="list-group-item d-flex justify-content-between align-items-end">
                    ${element[1]}
                    <button type="button" id="${element[0]}" forInp="${element[1]}" input=${input} onclick="agregarId(${element[0]})" class="btn btn-primary badge rounded-pill"><i class="bi bi-plus-square-dotted"></i></button>
                </li>
    
            `    
        });
    }
    //cambiamos el contenido
    $(id_response).html(template)
    $(id_response).show()
 

}

function agregarId(params) {
    //console.log(params);
    idButton = "#"+params;
    //console.log($(idButton).attr("forInp"));
    //console.log(idButton);
    let input = $(idButton).attr("input");

    switch (input) {
        case "cliente":
            $("#kf_cliente_id").val(params)
            $("#kf_cliente").val($(idButton).attr("forInp"))            
        break;
        case "producto":
            $("#temporal_tabla_id").val(params)
            $("#buscar_tabla_id").val($(idButton).attr("forInp"))
                
        break;
        default:
            bootbox.alert({title:"Error Busqueda",message:"Error en la Busqueda, intentelo mas tarde :("});
        break;
    }
    $(".response").hide()

}

$("#factura_efectivo").on("keyup",function(){
    let factura_efectivo = $("#factura_efectivo").val();
    let factura_total = $("#factura_total").val();
    let cambio = factura_total < factura_efectivo ?factura_total - factura_efectivo:0;
    let factura_cambio = cambio<0?cambio*-1:cambio;
    $("#factura_cambio").val(redondearDecimal(factura_cambio))
})