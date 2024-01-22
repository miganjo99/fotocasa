// function validate_referencia_catastral(texto){
//     if (texto.length > 0){
//         var reg = /^\d{4}[A-Za-z]$/;
//         console.log(reg.test(texto));
//         return reg.test(texto);
//     }
//     return false;
// }

function validate_fecha(texto){
    if (texto.length > 0){
        return true;
    }
    return false;
}
function validate_texto(texto){
    if (texto.length > 0){
        return true;
    }
    return false;
}



function validate_num(texto){
    if (texto.length > 0){
        return true;
    }
    return false;
}

function validate_opcion(array){
    var check=false;
    for ( var i = 0, l = array.options.length, o; i < l; i++ ){
        o = array.options[i];
        if ( o.selected ){
            check= true;
        }
    }
    return check;
}

function validate_radios(activo){
    if(activo == "On"){
        return true;
    }else if(activo == "Off"){
        return false;
    }

    return null;
}

function validate_js(op){

    var check=true;
    
    var v_referencia_catastral=document.getElementById("referencia_catastral").value;
    console.log("Ref Catastral-> ", v_referencia_catastral);
    // console.log(v_referencia_catastral);// VA BIEN

    var v_m2=document.getElementById('m2').value;
    var v_tipo_vivenda=document.getElementById('tipo_vivenda').value;
    var v_precio=document.getElementById('precio').value;

    //let v_fecha_publicacion = document.getElementById("fecha_publicacion");
    //console.log(v_fecha_publicacion);
    //console.log(v_fecha_publicacion.value);
    //console.log(v_fecha_publicacion.innerHTML);

    let v_ubicacion=document.getElementById('ubicacion').value;
    let v_num_habs=document.getElementById('num_habs').value;
    var radios = document.getElementsByName('Activo');

    var v_Activo = null;

    for (var i = 0; i < radios.length; i++) {

        if(radios[i].checked) {
            v_Activo = radios[i].value;
            break;
        }
    }

    //alert("op.1");
    var v_opcion=document.getElementById('opcion[]');
    //console.log(v_opcion);
    //alert("op.2");


    var r_referencia_catastral = false;
    if(v_referencia_catastral){
        var reg_referencia_catastral = /^\d{4}[A-Za-z]$/;
        r_referencia_catastral = reg_referencia_catastral.test(v_referencia_catastral);
    }

    //var r_referencia_catastral = validate_referencia_catastral(v_referencia_catastral);

        // nos devuelve 0 si no existe
        // nos devuelve 1 si existe
    //console.log(r_referencia_catastral);
        //return false;



    var r_tipo_vivenda=validate_texto(v_tipo_vivenda);
    //console.log("tipo vivienda " ,v_tipo_vivenda)
    if(v_tipo_vivenda == "ninguno"){
        r_tipo_vivenda = false;
    }
    var r_m2=validate_num(v_m2);

    var r_precio=validate_num(v_precio);
    //var r_fecha_publicacion = validate_fecha(v_fecha_publicacion);
    var r_fecha_publicacion = true

    var r_ubicacion=validate_texto(v_ubicacion);
    
    var r_num_habs=validate_num(v_num_habs);


    var r_activo = validate_radios(v_Activo);
    //console.log("validate radios ", r_activo);



    //alert("op.3");
    var r_opcion= validate_opcion(v_opcion);
    //console.log(r_opcion);
    //alert("op.4");





    // if (!/^\d{4}[A-Za-z]$/.test(v_referencia_catastral)6) {
    //     document.getElementById('error_referencia_catastral').innerHTML = " * La referencia catastral introducida no es válida";
    //     check = false;
    // } else {
    //     document.getElementById('error_referencia_catastral').innerHTML = "";
    // }

    // (r_referencia_catastral>0) ? 

    if(!r_referencia_catastral ){
        document.getElementById('error_referencia_catastral').innerHTML = " * La referencia catastral introducida no es valida";
        //console.log(r_referencia_catastral);
        //ret   urn false;
        check=false;
    }else{
        document.getElementById('error_referencia_catastral').innerHTML = "";
        
    }

    if(!r_tipo_vivenda){
        document.getElementById('error_tipo_vivenda').innerHTML = " * El tipo de vivienda introducida no es valida";
        check=false;
    }else{
        document.getElementById('error_tipo_vivenda').innerHTML = "";
    }

    if(!r_m2){
        document.getElementById('error_m2').innerHTML = " * Los m2 introducidos no son validos";
        check=false;
    }else{
        document.getElementById('error_m2').innerHTML = "";
    }

    if(!r_precio){
        document.getElementById('error_precio').innerHTML = " * El precio introducido no es valido";
        check=false;
    }else{
        document.getElementById('error_precio').innerHTML = "";
    }

    if(!r_fecha_publicacion){
        document.getElementById('error_fecha_publicacion').innerHTML = " * No has introducido ninguna fecha";
        check=false;
    }else{
        document.getElementById('error_fecha_publicacion').innerHTML = "";
    }

    if(!r_ubicacion){
        document.getElementById('error_ubicacion').innerHTML = " * La ubicacion introducida no es valida";
        check=false;
    }else{
        document.getElementById('error_ubicacion').innerHTML = "";
    }

    if(!r_num_habs){
        document.getElementById('error_num_habs').innerHTML = " * El numero de habitacions introducidas no es valido";
        check=false;
    }else{
        document.getElementById('error_num_habs').innerHTML = "";
    }

    if(r_activo == null){
        document.getElementById('error_activo').innerHTML = " * No has seleccionado ninguna opcion";
        check=false;
    }else{
        document.getElementById('error_activo').innerHTML = "";
    }
    //alert("Entrando a opcion validador");
    if(!r_opcion){
        document.getElementById('error_opcion').innerHTML = " * No has seleccionado ninguna opcion";
        check=false;
    }else{
        //alert("No pinta el error");
        document.getElementById('error_opcion').innerHTML = "";
    }
    //alert("Saliendo a opcion validador");


    if (check){
        if (op == 'create'){
            //window.location.href="index.php?page=controller_vivienda&op=create";
            console.log(op);
            //alert("Enviando a controlador");
            document.getElementById('alta_vivienda').submit();
            //alert("Submit al controlador");
            document.getElementById('alta_vivienda').action = "index.php?page=controller_vivienda&op=create";
        }
        if (op == 'update'){
            console.log(op);

            document.getElementById('update_vivienda').submit();
            document.getElementById('update_vivienda').action = "index.php?page=controller_vivienda&op=update";
        }
    }
    
    //console.log("Validacion-> ", check);
    return check;
}
function operations_vivienda(op){
    if (op == 'delete'){
        console.log(op);
        //alert("Hola delete");
        document.getElementById('delete_vivienda').submit();
        document.getElementById('delete_vivienda').action = "index.php?page=controller_vivienda&op=delete";
    }
    if (op == 'delete_all'){
        console.log(op);
        //alert("Hola delete_all");
        document.getElementById('delete_all_vivienda').submit();
        document.getElementById('delete_all_vivienda').action = "index.php?page=controller_vivienda&op=delete_all";
    }
    if (op == 'dummies'){
        console.log(op);
        //alert("Hola dummies");
        document.getElementById('dummies_vivienda').submit();
        document.getElementById('dummies_vivienda').action = "index.php?page=controller_vivienda&op=dummies";
    }
}


function showModal(title_vivienda, id) {
    $("#details_vivienda").show();
    $("#vivienda_modal").dialog({
        title: title_vivienda,
        width : 850,
        height: 500,
        resizable: "false",
        modal: "true",
        hide: "fold",
        show: "fold",
        buttons : {
            Update: function() {
                        window.location.href = 'index.php?module=cars&op=update&id=' + id;
                    },
            Delete: function() {
                        window.location.href = 'index.php?module=cars&op=delete&id=' + id;
                    }
        }
    });
}

function loadContentModal() {
    $('.vivienda').click(function () {
        var id = this.getAttribute('id');
        //alert(id);
        //$.get
        ajaxPromise('module/viviendas/controller/controller_vivienda.php?op=read_modal&id=' + id, 'GET', 'JSON')
        .then(function(data) {
            console.log(data);
            //alert("DATA");
            $('<div></div>').attr('id', 'details_vivienda', 'type', 'hidden').appendTo('#vivienda_modal');
            $('<div></div>').attr('id', 'container').appendTo('#details_vivienda');
            $('#container').empty();
            $('<div></div>').attr('id', 'vivienda_content').appendTo('#container');
            $('#vivienda_content').html(function() {
                var content = "";
                for (row in data) {
                    content += '<br><span>' + row + ': <span id =' + row + '>' + data[row] + '</span></span>';
                }
                return content;
                });
                showModal(title_vivienda = data.tipo_vivenda +", "+ data.referencia_catastral+", "+ data.precio+ " eur", data.id);
        })
        .catch(function() {
            window.location.href = 'index.php?module=errors&op=503&desc=List error';
        });
    });
 }

 $(document).ready(function() {
    loadContentModal();
});