/**
 * 
 * USO PARA EL USUSARIO O DEV
 * 
 */
let id = $("#temporal_tabla_id").attr("temporal_tabla_id")
let funcion = $("#temporal_tabla_id").attr("funcion")
let ta = $("#temporal_tabla_name").val()
let columna = $("#temporal_tabla_id").attr("columna")
function busqueda(inputB,tablaB,funcion,columna) {
    dir = url+funcion
    object = {
        "busqueda":inputB,
        "nombre_tabla":tablaB,
        "por_columna":columna,
        "columnas_requeridas":null
    }
    //console.log(inputB,tablaB);
    //console.log(dir); 
    //console.log(object);
    getDataForInput(dir,object)

}


function getDataForInput(dir,object) {
    $.post(dir,object,function(response) {
        console.log(response);
    }).fail(function(error){
        alert(error.responseText)
    })
}


if(id == 0){
    //keydown keypress la mejor forma es con keyup
    $("#temporal_tabla_id").on("keyup",function(e){
        let inputB = $("#temporal_tabla_id").val()
        busqueda(inputB,ta,funcion,columna)

    })
}