/**
 * 
 * USO PARA EL USUSARIO O DEV
 * 
 */
let id = $("#buscar_tabla_id").attr("buscar_tabla_id")
$(".responseB").hide()

function busqueda(inputB,tablaB,funcion,columna) {
    dir = url+funcion
    object = {
        "busqueda":inputB,
        "nombre_tabla":tablaB,
        "por_columna":columna,
        "columnas_requeridas":"`product_id`,`product_name`,`product_price`"
    }
    getDataForInput(dir,object)

}




function getDataForInput(dir,object) {
    //console.log(dir);
    $.post(dir,object,function(response) {
        //console.log(response);
        imprimirLista(response)
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
            
    busqueda(inputB,ta,funcion,columna)

})

$("#iva_porcentaje").on("change",()=>{
    let iva_porcentaje = $("#iva_porcentaje").val();
    let factura_subtotal = $("#factura_subtotal").val();
    let iva = parseFloat(factura_subtotal)*parseFloat(iva_porcentaje)/100;
    let total = parseFloat(factura_subtotal)+parseFloat(iva);
    //a*b/100
    $("#factura_iva").val(iva)
    $("#factura_total").val(total);
})

function imprimirLista(respuesta){
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
                    <button type="button" id="${element[0]}" forInp="${element[1]}" onclick="agregarId(${element[0]})" class="btn btn-primary badge rounded-pill"><i class="bi bi-plus-square-dotted"></i></button>
                </li>
    
            `    
        });
    }
    //cambiamos el contenido
    $(".responseB").html(template)
    $(".responseB").show()
 

}

function agregarId(params) {
    //console.log(params);
    idButton = "#"+params;
    //console.log($(idButton).attr("forInp"));
    //console.log(idButton);
    $("#temporal_tabla_id").val(params)
    $("#buscar_tabla_id").val($(idButton).attr("forInp"))
    $(".responseB").hide()

}
