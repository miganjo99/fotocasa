function carousel_tipo() {
    //alert("Hola JS ctrl_home");
    ajaxPromise('module/homepage/ctrl/ctrl_home.php?op=Carrousel_tipo','GET', 'JSON')
    .then(function(data) {        
        console.log(data);
        //var data = JSON.parse(data);
        
        for (row in data) {
                $('<div></div>').attr('class', "carousel__elements").attr('id', data[row].name_tipo).appendTo(".carousel__list")
                .html(
                    "<img class='carousel__img' id='' src='" + data[row].img_tipo + "' alt='' >"
                    +
                    "<h5 class='tipo_name'>" + data[row].name_tipo + "</h5>" 
                )
            }
            new Glider(document.querySelector('.carousel__list'), {
                slidesToShow: 3,
                dots: '.carousel__indicator',
                draggable: true,
                arrows: {
                    prev: '.carousel__prev',
                    next: '.carousel__next'
                }
            });
        })
        // .catch(function() {
        //     window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Carrusel_tipo HOME";
        // });
}


function loadCategorias() {
    ajaxPromise('module/homepage/ctrl/ctrl_home.php?op=homePageCategoria','GET', 'JSON')
    .then(function(data) {
        for (row in data) {
            $('<div></div>').attr('class', "div_cate").attr({ 'id': data[row].name_categoria }).appendTo('#containerCategories')
                .html(
                    "<li class='portfolio-item'>" +
                    "<div class='item-main'>" +
                    "<div class='portfolio-image'>" +
                    "<img src = " + data[row].img_categoria + " alt='foto' </img> " +
                    "</div>" +
                    "<h5>" + data[row].name_categoria + "</h5>" +
                    "</div>" +
                    "</li>"
                )
        }
    })
   //.catch(function() {
   //     window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Type_Categories HOME";
   // });
}   
function loadOperacion() {
    ajaxPromise('module/homepage/ctrl/ctrl_home.php?op=homePageOperacion','GET', 'JSON')
    .then(function(data) {
        for (row in data) {
            $('<div></div>').attr('class', "div_cate").attr({ 'id': data[row].name_operacion }).appendTo('#containerOperacion')
                .html(
                    "<li class='portfolio-item'>" +
                    "<div class='item-main'>" +
                    "<div class='portfolio-image'>" +
                    "<img src = " + data[row].img_operacion + " alt='foto'" +
                    "</div>" +
                    "<h5>" + data[row].name_operacion + "</h5>" +
                    "</div>" +
                    "</li>"
                )

        }
    })
    // .catch(function() {
    //     window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Types_car HOME";
    // });
}
function loadCiudad() {
    ajaxPromise('module/homepage/ctrl/ctrl_home.php?op=homePageCiudad','GET', 'JSON')
    .then(function(data) {
        for (row in data) {
            $('<div></div>').attr('class', "div_cate").attr({ 'id': data[row].name_ciudad }).appendTo('#containerCiudad')
                .html(
                    "<li class='portfolio-item'>" +
                    "<div class='item-main'>" +
                    "<div class='portfolio-image'>" +
                    "<img src = " + data[row].img_ciudad + " alt='foto' </img> " +
                    "</div>" +
                    "<h5>" + data[row].name_ciudad + "</h5>" +
                    "</div>" +
                    "</li>"
                )
        }
    })
   //.catch(function() {
   //     window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Type_Categories HOME";
   // });
}
function loadRecomendaciones() {
    ajaxPromise('module/homepage/ctrl/ctrl_home.php?op=homePageRecomendaciones','GET', 'JSON')
    .then(function(data) {
        console.log(data);
        for (row in data) {
            $('<div></div>').attr('class', "div_cate").attr({ 'id': data[row].id_vivienda }).appendTo('#containerRecomendaciones')
                .html(
                    "<li class='portfolio-item'>" +
                    "<div class='item-main'>" +
                    "<div class='portfolio-image'>" +
                    "<img src = " + data[row].img_vivienda + " alt='foto' </img> " +
                    "</div>" +
                    "<h5>" + data[row].estado + ",   " +data[row].m2+" m2"+ "</h5>" +
                    "</div>" +
                    "</li>"
                )
        }
    })
   //.catch(function() {
   //     window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Type_Categories HOME";
   // });
}




$(document).ready(function() {
    carousel_tipo();
    loadCategorias();
    loadOperacion();
    loadCiudad();
    loadRecomendaciones();
});