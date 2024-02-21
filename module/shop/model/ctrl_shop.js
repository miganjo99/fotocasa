function loadViviendas() {
    //localStorage.removeItem('filters_home');  
    // console.log(localStorage.getItem('filters_shop'));
    // alert("hola load shop");
    // se tiene que borrar el cache al final de function load_viviendas_filters_home()!!!!!!
    var verificate_filters_home = localStorage.getItem('filters_home') || null;//de false a null
   // var verificate_filters_shop = localStorage.getItem('filters_shop') || null;//de false a null
    
    if (verificate_filters_home !=  null) {//un unico filters
        //console.log(verificate_filters);
        //alert("entrando en load_viviendas_filters_home");
        load_viviendas_filters_home();
    
    }
    else {
       
        ajaxForSearch('module/shop/ctrl/ctrl_shop.php?op=all_viviendas');
    }
}

function print_filters() {
    //get stringify
    //set parse
    //localStorage.setItem('filters_shop', JSON.stringify(filters_shop)); 
    //.parse=string a json

    //.stringify= obj 
    $('<div class="div-filters"></div>').appendTo('.filters_shop')
        .html(
            '<br>'+
            '&nbsp'+ '&nbsp'+
            '<select class="filter_operacion">' +
            '<option value="0">Operación</option>' +
            '<option value="1">Compra</option>' +
            '<option value="2">Alquiler</option>' +
            '<option value="3">Compartir</option>' +
            '<option value="4">Alquiler de habitación</option>' +
            '<option value="5">Alquiler con compra</option>' +
            '</select>' +
            /////////////////////////////// MODAL CIUDAD/////////////////////////////////////
            '&nbsp'+
            '<input type="radio" name="ciudad" class="filter_ciudad" value="1" id="Valencia">' +
            '<label for="Valencia">Valencia</label>' +
            '&nbsp'+
            '<input type="radio" name="ciudad" class="filter_ciudad" value="2" id="Madrid">' +
            '<label for="Madrid">Madrid</label>' +
            '&nbsp'+
            '<input type="radio" name="ciudad" class="filter_ciudad" value="3" id="Barcelona">' +
            '<label for="Barcelona">Barcelona</label>' +
            '&nbsp'+
            '<input type="radio" name="ciudad" class="filter_ciudad" value="4" id="Santander">' +
            '<label for="Santander">Santander</label>' +
            '&nbsp'+
            '<input type="radio" name="ciudad" class="filter_ciudad" value="5" id="Ontinyent">' +
            '<label for="Ontinyent">Ontinyent</label>' +
            '&nbsp'+
            
            '<select class="filter_tipo">' +
            '<option value="0">Tipo de vivienda</option>' +
            '<option value="1">chalet</option>' +
            '<option value="2">finca</option>' +
            '<option value="3">piso</option>' +
            '<option value="4">casa</option>' +
            '<option value="5">apartamento</option>' +
            '</select>' +

            '&nbsp'+

            '<select class="filter_precio">' +
            '<option value="precio_mayor">Precio de mas a menos </option>' +
            '<option value="precio_menor">Precio de menos a mas </option>' +            
            '</select>' +

            '<div id="overlay">' +
            '<div class= "cv-spinner" >' +
            '<span class="spinner"></span>' +
            '</div >' +
            '</div > ' +
            '</div>' +
            '</div>' +
            '<p> </p>' +
            '<button class="filter_button button_spinner" id="filter_button">Filter</button>' +
            '<button class="filter_remove" id="Remove_filter">Remove</button>');

            $(document).on('click', '.Remove_filter', function() {
                remove_filters();
            });
}

function shopAll() {
    var filters_shop = localStorage.getItem('filters_shop');
    //var filters_shop = JSON.stringify(localStorage.getItem('filters_shop'));

   
    console.log(filters_shop);
    alert("shopall");
    // if (filters_shop) {
    //     ajaxForSearch("module/shop/crtl/crtl_shop.php?op=filter", filters_shop);
    // } else {
    //     ajaxForSearch("module/shop/crtl/crtl_shop.php?op=all_viviendas");
    // }
}

function filter_button() {
    

    $(function() {
        $('.filter_operacion').change(function() {
            localStorage.setItem('filter_operacion', "Hola");
        });
        if (localStorage.getItem('filter_operacion')) {
            $('.filter_operacion').val(localStorage.getItem('filter_operacion'));
        }
    });
    // $(function() {
    //     $('.filter_order').change(function() {
    //         localStorage.setItem('filter_order', this.value);
    //     });
    //     if (localStorage.getItem('filter_order')) {
    //         $('.filter_order').val(localStorage.getItem('filter_order'));
    //     }
    // });
    
    
}


function remove_filters() {
    localStorage.removeItem('filters_home');
    
    location.reload();
}

function ajaxForSearch(url) {
    //alert(url);
    //localStorage.removeItem('filters_home')
    ajaxPromise(url, 'GET', 'JSON')
        .then(function(data) {
            // console.log(data);
           //alert("ajaxPromise shop dentro");
            $('#content_shop_viviendas').empty();
            $('.date_vivienda' && '.date_img').empty();
            //  $('.date_img_array').empty();

            //Mejora para que cuando no hayan resultados en los filtros aplicados
            
            if (data == "error") {
                $('<div></div>').appendTo('#content_shop_viviendas')
                    .html(
                        '<h3>¡No se encuentarn resultados con los filtros aplicados!</h3>'
                    )
            } else {
                
                for (row in data) {
                    
                    
                    $('<div></div>').attr({ 'id': data[row].id_vivienda, 'class': 'list_content_shop' }).appendTo('#content_shop_viviendas')
                        .html(
                            "<div class='list_product'>" +
                            "<div class='img-container'>" +
                            "<img src= '" + data[row].img_vivienda + "'" + "</img>" +
                            "</div>" +
                            "<div class='product-info'>" +
                            "<div class='product-content'>" +
                            "<h1><b>" + data[row].precio + "\u20AC " + "</b></h1>" +
                            "<p>Up-to-date maintenance and revisions</p>" +
                            "<ul>" +
                            "<li> <i id='col-ico' class='fa-solid fa-bath'></i>&nbsp;" + data[row].aseos + " aseos" + "</li>" +
                            "<li> <i id='col-ico' class='fa-solid fa-trowel'></i>&nbsp;" + data[row].estado + "</li>" +
                            "<li> <i id='col-ico' class='fa-solid fa-bed'></i>&nbsp;" + data[row].num_habs + " habitaciones" + "</li>" +
                            "</ul>" +
                            "<div class='buttons'>" +
                            "<button id='" + data[row].id_vivienda + "' class='more_info_list button add' >More Info</button>" +
                            "<button class='button buy' >Buy</button>" +
                            "<span class='button' id='price'>" + data[row].precio + '€' + "</span>" +
                            "</div>" +
                            "</div>" +
                            "</div>" +
                            "</div>"
                        )
                       
                }
            }
        }).catch(function() {
           // window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Function ajxForSearch SHOP";
        });
        
}

function clicks() {
    
    $(document).on("click", ".more_info_list", function() {
        var id_vivienda = this.getAttribute('id');
        //console.log(id_vivienda);
        //alert("button more info");
        loadDetails(id_vivienda);
    });
}

function loadDetails(id_vivienda) {
    ajaxPromise('module/shop/ctrl/ctrl_shop.php?op=details_vivienda&id=' + id_vivienda, 'GET', 'JSON')
    .then(function(data) {
        //console.log(data);
        //alert("load details");
        $('#content_shop_viviendas').empty();
        $('.date_img_dentro').empty();
        $('.date_vivienda_dentro').empty();

        for (row in data[1][0]) {
            $('<div></div>').attr({ 'id': data[1][0].id_img, class: 'date_img_dentro' }).appendTo('.date_img')
                .html(
                    "<div class='content-img-details'>" +
                    "<img src= '" + data[1][0][row].img_vivienda + "'" + "</img>" +
                    "</div>"
                )
        }

        $('<div></div>').attr({ 'id': data[0].id_vivienda, class: 'date_vivienda_dentro' }).appendTo('.date_vivienda')
            .html(
                
                "<div class='list_product_details'>" +
                "<div class='product-info_details'>" +
                "<div class='product-content_details'>" +
                "<h1><b>" + data[0].precio +" "+ "<i class='fa-solid fa-euro-sign'></i>"+"</b></h1>" +
                "<hr class=hr-shop>" +
                "<table id='table-shop'> <tr>" +
                "<td> <i id='col-ico' class='fa-regular fa-calendar fa-2xl'></i> &nbsp;" + data[0].antiguedad + " años" + "</td>" +
                "<td> <i id='col-ico' class='fa-solid fa-door-open fa-2xl'></i> &nbsp;" + data[0].num_habs + " habitaciones" + "</td>  </tr>" +
                "<td> <i id='col-ico' class='fa-solid fa-calendar-days fa-2xl'></i> &nbsp;" + data[0].fecha_publicacion + "</td>" +
                "<td> <i id='col-ico' class='fa-solid fa-bath fa-2xl'></i> &nbsp;" + data[0].aseos + " aseos"+ "</td>  </tr>" +
                "<td> <i id='col-ico' class='fa-solid fa-house fa-2xl'></i> &nbsp;" + data[0].name_tipo + "</td>" +
                "<td> <i id='col-ico' class='fa-solid fa-key fa-2xl'></i> &nbsp;" + data[0].name_operacion + "</td>  </tr>" +
                "<td> <i id='col-ico' class='fa-solid fa-city fa-2xl'></i> &nbsp;" + data[0].name_ciudad + "</td>" +
                "<td> <i id='col-ico' class='fa-solid fa-trowel fa-2xl'></i> &nbsp;" + data[0].name_categoria + "</td>" +
                "</table>" +
                "<hr class=hr-shop>" +
                "<h3><b>" + "Descripción:" + "</b></h3>" +
                "<p>" + data[0].descripcion + "</p>" +
                "<div class='buttons_details'>" +
                "<a class='button add' href='#'>Contactar</a>" +
                "<a class='button buy' href='#'>Guardar</a>" +
                "<span class='button' id='price_details'>" + data[0].precio +" "+ "<i class='fa-solid fa-euro-sign'></i> </span>" +
                "<a class='details__heart' id='" + data[0].id_vivienda + "'><i id=" + data[0].id_vivienda + " class='fa-solid fa-heart fa-lg'></i></a>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "</div>"
            )


        $('.date_img').slick({
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            adaptiveHeight: true,
            autoplay: true,
            autoplaySpeed: 2600
        });
    }).catch(function() {
        // window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Load_Details SHOP";
    });
}


function load_viviendas_filters_home() {
    var filters_home = JSON.parse(localStorage.getItem('filters_home'));
    //console.log(filtros);
    //alert("filtros");
    // return false;



    ajaxPromise('module/shop/ctrl/ctrl_shop.php?op=redirect_home', 'POST', 'JSON', { 'filters_home': filters_home })

        .then(function(shop) {
            //console.log(shop);
            //return false;
            //alert(".then");
            $("#content_shop_viviendas").empty();
            for (row in shop) {
                //$('<div></div>').appendTo('#containerShop')
                $('<div></div>').attr({ 'id': shop[row].id_vivienda, 'class': 'list_content_shop' }).appendTo('#content_shop_viviendas')
                .html(
                    "<div class='list_product'>" +
                    "<div class='img-container'>" +
                    "<img src= '" + shop[row].img_vivienda + "'" + "</img>" +
                    "</div>" +
                    "<div class='product-info'>" +
                    "<div class='product-content'>" +
                    "<h1><b>" + shop[row].precio + "\u20AC " + "</b></h1>" +
                    "<p>Up-to-date maintenance and revisions</p>" +
                    "<ul>" +
                    "<li> <i id='col-ico' class='fa-solid fa-bath'></i>&nbsp;" + shop[row].aseos + " aseos" + "</li>" +
                    "<li> <i id='col-ico' class='fa-solid fa-trowel'></i>&nbsp;" + shop[row].estado + "</li>" +
                    "<li> <i id='col-ico' class='fa-solid fa-bed'></i>&nbsp;" + shop[row].num_habs + " habitaciones" + "</li>" +
                    "</ul>" +
                    "<div class='buttons'>" +
                    "<button id='" + shop[row].id_vivienda + "' class='more_info_list button add' >More Info</button>" +
                    "<button class='button buy' >Buy</button>" +
                    "<span class='button' id='price'>" + shop[row].precio + '€' + "</span>" +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
                )
            }
            // mapBox_all(shop);
        }).catch(function() {
            // window.location.href = "index.php?modules=exception&op=503&error=fail_salto&type=503";
        });
        //borrar caché????
        //
        //
        //
        //
        localStorage.removeItem('filters_home');
}

$(document).ready(function() {
    loadViviendas();
    clicks();
    print_filters();
    filter_button();
    load_viviendas_filters_home();
}); 
