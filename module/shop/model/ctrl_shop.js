function loadViviendas() {
    //alert("hola load shop");

    ajaxForSearch('module/shop/ctrl/ctrl_shop.php?op=all_viviendas');
}

function ajaxForSearch(url) {
    //alert(url);
    ajaxPromise(url, 'GET', 'JSON')
        .then(function(data) {
            console.log(data);
            // alert("ajaxPromise shop dentro");


            $('#content_shop_viviendas').empty();
            $('.date_vivienda' && '.date_img').empty();

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
                            "<h1><b>" + data[row].id_vivienda + " " + data[row].estado + "<a class='list__heart' id='" + data[row].id_opreacion + "'><i id= " + data[row].id_categoria + " class='fa-solid fa-heart fa-lg'></i></a>" + "</b></h1>" +
                            "<p>Up-to-date maintenance and revisions</p>" +
                            "<ul>" +
                            "<li> <i></i> " + data[row].aseos + " aseos" + "</li>" +
                            "<li> <i id='col-ico' class='fa-solid fa-person fa-xl'></i>&nbsp;&nbsp;&nbsp;" + data[row].estado + "</li>" +
                            "<li> <i id='col-ico' class='fa-solid fa-palette fa-xl'></i>&nbsp;" + data[row].num_habs + " habitaiones" + "</li>" +
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

// function clicks() {
//     $(document).on("click", ".more_info_list", function() {
//         var id_car = this.getAttribute('id');
//         loadDetails(id_car);
//     });
// }

// function loadDetails(id_car) {
//     ajaxPromise('module/shop/ctrl/ctrl_shop.php?op=details_car&id=' + id_car, 'GET', 'JSON')
//     .then(function(data) {
//         $('#content_shop_cars').empty();
//         $('.date_img_dentro').empty();
//         $('.date_car_dentro').empty();

//         for (row in data[1][0]) {
//             $('<div></div>').attr({ 'id': data[1][0].id_img, class: 'date_img_dentro' }).appendTo('.date_img')
//                 .html(
//                     "<div class='content-img-details'>" +
//                     "<img src= '" + data[1][0][row].img_cars + "'" + "</img>" +
//                     "</div>"
//                 )
//         }

//         $('<div></div>').attr({ 'id': data[0].id_car, class: 'date_car_dentro' }).appendTo('.date_car')
//             .html(
//                 "<div class='list_product_details'>" +
//                 "<div class='product-info_details'>" +
//                 "<div class='product-content_details'>" +
//                 "<h1><b>" + data[0].id_brand + " " + data[0].name_model + "</b></h1>" +
//                 "<hr class=hr-shop>" +
//                 "<table id='table-shop'> <tr>" +
//                 "<td> <i id='col-ico' class='fa-solid fa-road fa-2xl'></i> &nbsp;" + data[0].Km + "KM" + "</td>" +
//                 "<td> <i id='col-ico' class='fa-solid fa-person fa-2xl'></i> &nbsp;" + data[0].gear_shift + "</td>  </tr>" +
//                 "<td> <i id='col-ico' class='fa-solid fa-car fa-2xl'></i> &nbsp;" + data[0].name_cat + "</td>" +
//                 "<td> <i id='col-ico' class='fa-solid fa-door-open fa-2xl'></i> &nbsp;" + data[0].num_doors + "</td>  </tr>" +
//                 "<td> <i id='col-ico' class='fa-solid fa-gas-pump fa-2xl'></i> &nbsp;" + data[0].name_tmotor + "</td>" +
//                 "<td> <i id='col-ico' class='fa-solid fa-calendar-days fa-2xl'></i> &nbsp;" + data[0].matricualtion_date + "</td>  </tr>" +
//                 "<td> <i id='col-ico' class='fa-solid fa-palette fa-2xl'></i> &nbsp;" + data[0].color + "</td>" +
//                 "<td> <i class='fa-solid fa-location-dot fa-2xl'></i> &nbsp;" + data[0].city + "</td> </tr>" +
//                 "</table>" +
//                 "<hr class=hr-shop>" +
//                 "<h3><b>" + "More Information:" + "</b></h3>" +
//                 "<p>This vehicle has a 2-year warranty and reviews during the first 6 months from its acquisition.</p>" +
//                 "<div class='buttons_details'>" +
//                 "<a class='button add' href='#'>Add to Cart</a>" +
//                 "<a class='button buy' href='#'>Buy</a>" +
//                 "<span class='button' id='price_details'>" + data[0].price + "<i class='fa-solid fa-euro-sign'></i> </span>" +
//                 "<a class='details__heart' id='" + data[0].id_car + "'><i id=" + data[0].id_car + " class='fa-solid fa-heart fa-lg'></i></a>" +
//                 "</div>" +
//                 "</div>" +
//                 "</div>" +
//                 "</div>"
//             )

//         $('.date_img').slick({
//             infinite: true,
//             speed: 300,
//             slidesToShow: 1,
//             adaptiveHeight: true,
//             autoplay: true,
//             autoplaySpeed: 1500
//         });
//     }).catch(function() {
//         // window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Load_Details SHOP";
//     });
// }

$(document).ready(function() {
    loadViviendas();
    //clicks();
});
