function loadViviendas() {
    //alert("hola load shop");

    ajaxForSearch('module/shop/ctrl/ctrl_shop.php?op=all_viviendas');
}

function ajaxForSearch(url) {
    //alert(url);
    ajaxPromise(url, 'GET', 'JSON')
        .then(function(data) {
            // console.log(data);
           // alert("ajaxPromise shop dentro");


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
                // <script>
                //              for (row in data[1][0]) {
                //                 $('<div></div>').attr({ 'id': data[1][0].id_vivienda, class: 'date_img_array' }).appendTo('.date_img_list')
                //                     .html(
                //                         "<div class='content-img-list'>" +
                //                         "<img src= '" + data[1][0][row].img_vivienda + "'" + "</img>" +
                //                         "</div>"
                //                     )
                //                 }
                //                 </script>
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
                        // $('.date_img_list').slick({
                        //     infinite: true,
                        //     speed: 300,
                        //     slidesToShow: 1,
                        //     adaptiveHeight: true,
                        //     autoplay: true,
                        //     autoplaySpeed: 2600
                        // });
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
// function load_filters(total_prod = 0, items_page = 3) {
//     var filtros = JSON.parse(localStorage.getItem('filters'));
//     ajaxPromise('modules/shop/crtl/crtl_shop.php?op=redirect', 'POST', 'JSON', { 'filtros': filtros, 'total_prod': total_prod, 'items_page': items_page })
//         .then(function(shop) {
//             $("#containerShop").empty();
//             for (row in shop) {
//                 $('<div></div>').appendTo('#containerShop')
//                     .html(
//                         '<div id="overlay">' +
//                         '<div class= "cv-spinner" >' +
//                         '<span class="spinner"></span>' +
//                         '</div >' +
//                         '</div > ' +
//                         '</div>' +
//                         '</div>' +
//                         '<div class="page">' +
//                         '<section class="section section-md bg-white">' +
//                         '<div class="shell">' +
//                         '<div class="range range-50 range-sm-center range-md-left range-md-middle range-md-reverse">' +
//                         '<div class="cell-sm-6 wow fadeInRightSmall">' +
//                         ' <div class="thumb-line"><img src="' + shop[row].img + '" alt="" width="531" height="640"/>' +
//                         '</div>' +
//                         '</div>' +
//                         '<div class="cell-sm-6">' +
//                         '<div class="box-width-3">' +
//                         '<p class="heading-1 wow fadeInLeftSmall">' + shop[row].brand_name + '</p>' +
//                         '<article class="quote-big wow fadeInLeftSmall" data-wow-delay=".1s">' +
//                         '<p class="q">' + shop[row].modelo + '</p>' +
//                         '<p class="q">' + shop[row].precio + '€</p>' +
//                         '<p class="q">' + shop[row].cat_name + '</p>' +
//                         '</article>' +
//                         '<div class="divider wow fadeInLeftSmall" data-wow-delay=".2s"></div>' +
//                         '<p class="q">' + shop[row].type_name + '<i class="fa-thin fa-gas-pump fa-2xl"></i></p>' +
//                         '<p class="wow fadeInLeftSmall" data-wow-delay=".3s">' + shop[row].puertas + '<i class="fa-solid fa-door-open fa-2xl"></i></p><a class="button button-primary-outline button-ujarak button-size-1 wow fadeInLeftSmall link button_spinner" data-wow-delay=".4s" id="' + shop[row].id + '">Read More</a>' +
//                         '</div>' +
//                         '</div>' +
//                         '</section>' +
//                         '</div>');
//             }
//             mapBox_all(shop);
//         }).catch(function() {
//             window.location.href = "index.php?modules=exception&op=503&error=fail_salto&type=503";
//         });
// }

$(document).ready(function() {
    loadViviendas();
    clicks();
});
