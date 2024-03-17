function loadViviendas() {
    
    var verificate_filters_home = localStorage.getItem('filters_home') || null;//de false a null
    var verificate_filters_shop = localStorage.getItem('filters_shop') || null;//de false a null
    var verificate_filters_search = localStorage.getItem('filters_search') || null;//de false a null
    
    

    if (verificate_filters_home !=  null) {//un unico filters
        
        load_viviendas_filters_home();
    
    }else if(verificate_filters_shop !=  null){
        
        var filters_shop=JSON.parse(verificate_filters_shop);
        ajaxForSearch("module/shop/ctrl/ctrl_shop.php?op=filter", 'POST', 'JSON', { 'filters_shop': filters_shop });
        
        //highlightFilters();
        setTimeout(() => {
            highlightFilters();
            
          }, "1000");
          
    }else if(verificate_filters_search !=  null){
        
        var filters_search=JSON.parse(verificate_filters_search);
        console.log("filters_search:",filters_search);
        ajaxForSearch("module/shop/ctrl/ctrl_shop.php?op=search", 'POST', 'JSON', { 'filters_search': filters_search });
          
    }
    else {
       
        ajaxForSearch('module/shop/ctrl/ctrl_shop.php?op=all_viviendas','GET', 'JSON');
    }
}

function print_filters() {
    
    
    
    var filters_container = $('<div class="filters_container"></div>');
    

    // var selectElement1 = $('<div class="div-filters-ordenar"></div>').html(
    //     '<select class="filter_ordenar">' +
    //     '<option value="1">Ordenar precio de menor a mayor</option>' +
    //     '<option value="2">Ordenar precio de mayor a menor</option>' +
    //     '</select>'
    // );
    // filters_container.append(selectElement1);

    // ajaxPromise('module/shop/ctrl/ctrl_shop.php?op=filtro_ordenar', 'POST', 'JSON', { 'filters_shop': filters_shop })
    // .then(function(data) {

    // //     var selectElement1 = $('<div class="div-filters-ordenar"></div>').html(
    // //     '<select class="filter_ordenar">' +
    // //     '<option value="1">Ordenar precio de menor a mayor</option>' +
    // //     '<option value="2">Ordenar precio de mayor a menor</option>' +
    // //     '</select>'
    // // );
    //     //filters_container.append(selectElement1);
    //     ajaxForSearch("module/shop/ctrl/ctrl_shop.php?op=filter", 'POST', 'JSON', { 'filters_shop': filters_shop });

    // });

    ajaxPromise('module/shop/ctrl/ctrl_shop.php?op=filtro_operacion', 'POST', 'JSON')
    .then(function(data) {
        var selectElement = $('<select class="filter_operacion" id="filter_operacion"></select>'); 
        selectElement.append($('<option class="filter_operacion" id="filter_operacion" value="0">Operacion</option>'));
        for (var row in data) {
            selectElement.append($('<option></option>').attr('value', data[row].id_operacion).text(data[row].name_operacion));
        }
        filters_container.append(selectElement); 
    });

    ajaxPromise('module/shop/ctrl/ctrl_shop.php?op=filtro_ciudad', 'POST', 'JSON')
    .then(function(data) {
        var selectElement = $('<select class="filter_ciudad" id="filter_ciudad"></select>'); 
        selectElement.append($('<option class="filter_ciudad" id="filter_ciudad" value="0">Ciudad</option>'));

        for (var row in data) {
            selectElement.append($('<option></option>').attr('value', data[row].id_ciudad).text(data[row].name_ciudad));
        }
        filters_container.append(selectElement); 
    });

    ajaxPromise('module/shop/ctrl/ctrl_shop.php?op=filtro_tipo', 'POST', 'JSON')
    .then(function(data) {
        var selectElement = $('<select class="filter_tipo" id="filter_tipo"></select>'); 
        selectElement.append($('<option class="filter_tipo" id="filter_tipo" value="0">Tipo</option>'));

        for (var row in data) {
            selectElement.append($('<option></option>').attr('value', data[row].id_tipo).text(data[row].name_tipo));
        }
        filters_container.append(selectElement); 
    });
    
    ajaxPromise('module/shop/ctrl/ctrl_shop.php?op=filtro_categoria', 'POST', 'JSON')
    .then(function(data) {
        var selectElement = $('<select class="filter_categoria" id="filter_categoria"></select>'); 
        selectElement.append($('<option class="filter_categoria" id="filter_categoria" value="0">Categoria</option>'));

        for (var row in data) {
            selectElement.append($('<option></option>').attr('value', data[row].id_categoria).text(data[row].name_categoria));
        }
        filters_container.append(selectElement); 
    });
    
    ajaxPromise('module/shop/ctrl/ctrl_shop.php?op=filtro_orientacion', 'POST', 'JSON')
    .then(function(data) {
        var radio = $('<div class="radio_container"></div>'); 

        for (var row in data) {
            var eleccion_orientacion = $('<label></label>').text(data[row].name_orientacion);
            eleccion_orientacion.prepend('<input type="radio" name="orientacion" class="filter_orientacion" value="' + data[row].id_orientacion + '"> ');
            radio.append(eleccion_orientacion);
        }

        filters_container.append(radio); 
    });

    
        

    var botones = '<button class="filter_button button_spinner" id="filter_button">Filter</button>' +
                '<button class="filter_remove" id="Remove_filter">Remove</button>' +
                '<button class="ultima_busqueda" id="ultima_busqueda">ultima busqueda</button>';
    filters_container.append(botones);

            
    $('.filters_shop').html(filters_container);
                      
    
    $(document).on('click', '.filter_remove', function() {
        remove_filters();
    });

    $(document).on('click', '.ultima_busqueda', function() {
        ultima_busqueda();
    });
        //localStorage.removeItem('filters_shop');//se borran aqui los filtros?        
}

function ultima_busqueda() {
    
    var ultima_busqueda = localStorage.getItem('id');
    console.log("ultima_busqueda",ultima_busqueda);
    //var filter_ult=JSON.parse(ultima_busqueda);
       // ajaxForSearch("module/shop/ctrl/ctrl_shop.php?op=filter_ult", 'POST', 'JSON', ultima_busqueda);

        ajaxPromise('module/shop/ctrl/ctrl_shop.php?op=filter_ult&ultima_busqueda=' + ultima_busqueda, 'GET', 'JSON')
        .then(function(data) {
            console.log(data);
           // alert("load details");

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

function filter_button() {

    

    $(document).on('change', '.filter_ordenar', function() {
        console.log("Hola");
        console.log(this.value);
        localStorage.setItem('filter_ordenar', this.value);
    });
    if (localStorage.getItem('filter_ordenar')) {
        $('.filter_ordenar').val(localStorage.getItem('filter_ordenar'));
    }



    $(document).on('change', '.filter_operacion', function() {
        console.log("Hola");
        console.log(this.value);
        localStorage.setItem('filter_operacion', this.value);
    });
    if (localStorage.getItem('filter_operacion')) {
        $('.filter_operacion').val(localStorage.getItem('filter_operacion'));
    }


    

    $(document).on('change', '.filter_ciudad', function() {
        console.log("Hola");
        console.log(this.value);
        localStorage.setItem('filter_ciudad', this.value);
    });   
    if (localStorage.getItem('filter_ciudad')) {
        $('.filter_ciudad').val(localStorage.getItem('filter_ciudad'));
    }


    $(document).on('change', '.filter_tipo', function() {
        console.log("Hola");
        console.log(this.value);
        localStorage.setItem('filter_tipo', this.value);
    });
    if (localStorage.getItem('filter_tipo')) {
        $('.filter_tipo').val(localStorage.getItem('filter_tipo'));
    }


    $(document).on('change', '.filter_categoria', function() {
        console.log("Hola");
        console.log(this.value);
        localStorage.setItem('filter_categoria', this.value);
    });
    if (localStorage.getItem('filter_categoria')) {
        $('.filter_categoria').val(localStorage.getItem('filter_categoria'));
    }

    $(document).on('change', '.filter_orientacion', function() {
        console.log("Hola");
        console.log(this.value);
        localStorage.setItem('filter_orientacion', this.value);
    });
    if (localStorage.getItem('filter_orientacion')) {
        $('.filter_orientacion').val(localStorage.getItem('filter_orientacion'));
    }


    






    $(document).on('click', '.filter_button', function () {
        var filters_shop = [];

        if (localStorage.getItem('filter_ordenar')) {
            filters_shop.push(['precio', localStorage.getItem('filter_ordenar')])
        }
        
        if (localStorage.getItem('filter_operacion')) {
            filters_shop.push(['id_operacion', localStorage.getItem('filter_operacion')])
        }
        if (localStorage.getItem('filter_ciudad')) {
            filters_shop.push(['id_ciudad', localStorage.getItem('filter_ciudad')])
        }
        if (localStorage.getItem('filter_tipo')) {
            filters_shop.push(['id_tipo', localStorage.getItem('filter_tipo')])
        }
        if (localStorage.getItem('filter_categoria')) {
            filters_shop.push(['id_categoria', localStorage.getItem('filter_categoria')])
        }
        if (localStorage.getItem('filter_orientacion')) {
            filters_shop.push(['id_orientacion', localStorage.getItem('filter_orientacion')])
        }
       
    
        localStorage.removeItem('filters_shop'); 

        localStorage.setItem('filters_shop', JSON.stringify(filters_shop));   
        

        //localStorage.setItem('filters_shop', JSON.stringify(filters_ultimos));   

        location.reload();
        

        
    
    });
    
}

function highlightFilters() {
    
    
    var all_filters = JSON.parse(localStorage.getItem('filters_shop'));
    
    console.log("all_filters", all_filters);
    
    for (var i = 0; i < all_filters.length; i++) {
        var filter = all_filters[i];
        console.log("FILTER", filter);
    
        var nombre = filter[0];
        var valor = filter[1];
    
        if (nombre === 'id_operacion') {
            console.log('id_operacion', valor);
            $('#filter_operacion').val(valor);
        }
        if (nombre === 'id_ciudad') {
            console.log('id_ciudad', valor);
            $('#filter_ciudad').val(valor);
        }
        if (nombre === 'id_tipo') {
            console.log('id_tipo', valor);
            $('#filter_tipo').val(valor);
        }
        if (nombre === 'id_categoria') {
            console.log('id_categoria', valor);
            $('#filter_categoria').val(valor);
        }
        if (nombre === 'id_orientacion') {
            $('input[name="orientacion"][value="' + valor + '"]').prop('checked', true);
        }
    }


}
    

function remove_filters() {
    

    localStorage.removeItem('filters_shop');
    localStorage.removeItem('filters_search');
    localStorage.removeItem('filter_operacion');
    localStorage.removeItem('filter_ciudad');
    localStorage.removeItem('filter_tipo');
    localStorage.removeItem('filter_categoria');
    localStorage.removeItem('filter_orientacion');
    localStorage.removeItem('filter_ordenar');
    // localStorage.removeItem('filter_habitaciones');
    
    location.reload();
}

function ajaxForSearch(url, type, JSON, data=undefined) {
    //alert(url);
    //localStorage.removeItem('filters_home')
    
    ajaxPromise(url, type, JSON, data)
        .then(function(data) {
             //console.log("RETURN CONSULTA",data);
            
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
                mapLeaflet_all(data);
            }
        }).catch(function() {
           // window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Function ajxForSearch SHOP";
            // $('#content_shop_viviendas').empty();
            //     $('<div></div>').appendTo('#content_shop_viviendas')
            //     .html('<h1>No hay viviendas con estos filtros</h1>');
        });
        
}

function clicks() {
    
    $(document).on("click", ".more_info_list", function() {
        var id_vivienda = this.getAttribute('id');
        //console.log(id_vivienda);
        //alert("button more info");
       
        localStorage.setItem('id', id_vivienda);
        //console.log(localStorage.getItem('id'));

        loadDetails(id_vivienda);
    });
}

function loadDetails(id_vivienda) {
    ajaxPromise('module/shop/ctrl/ctrl_shop.php?op=details_vivienda&id=' + id_vivienda, 'GET', 'JSON')
    .then(function(data) {
        //console.log(data);
        //alert("load details");
        //$('#map').empty();
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
        mapLeaflet(data);
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

function mapLeaflet_all(data) {
   
        var map = L.map('map').setView([40.521506, -3.695466], 6);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map); 


        L.marker([39.078138, 125.750723]).addTo(map)
            .bindPopup('MARCADOR');

            for (var i = 0; i < data.length; i++) {
                var marker = L.marker([data[i].lat, data[i].long]).addTo(map);
                var popupContent = '<h3 style="text-align:center;">' + data[i].precio + '€</h3>' +
                                   '<p style="text-align:center;">Estado: <b>' + data[i].estado + '</b></p>' +
                                   '<p style="text-align:center;">Descripcion: <b>' + data[i].descripcion + '</b></p>' +
                                   '<img src="' + data[i].img_vivienda + '"/>' +
                                   '<a class="button button-primary-outline button-ujarak button-size-1 wow fadeInLeftSmall more_info_list" ' +
                                   'data-wow-delay=".4s" id="' + data[i].id_vivienda + '">Read More</a>';
                marker.bindPopup(popupContent);
            }

           
}

function mapLeaflet(data) {
    

    console.log("mapa details", data[0].lat);
     //alert("hola mapLeaflet "),
     //$('#map').empty();

    //const map = L.map('map').setView([0, 0], 10); // inicio mapa

    var map =L.map('map').setView([data[0].lat, data[0].long], 12); 
    
    
    console.log("map::",map);
    //L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    //var map = L.map('map').setView([51.505, -0.09], 13);

        //var marker = L.marker([data[0].lat, data[0].long]).addTo(map);
        // const popupContent = '<h3 style="text-align:center;">' + data[0].precio + '€</h3>' +
        // '<p style="text-align:center;">Estado: <b>' + data[0].estado + '</b></p>' +
        // '<p style="text-align:center;">Descripcion: <b>' + data[0].descripcion + '</b></p>' +
        // '<img src="' + data[0].img_vivienda + '"/>' +
        // '<a class="button button-primary-outline button-ujarak button-size-1 wow fadeInLeftSmall link" ' +
        // 'data-wow-delay=".4s" id="' + data[0].id_vivienda + '">Read More</a>';

        // marker.bindPopup(popupContent).openPopup();
        
    
     
}

$(document).ready(function() {
    print_filters();
    loadViviendas();
    filter_button();
    clicks();
    load_viviendas_filters_home();
}); 
