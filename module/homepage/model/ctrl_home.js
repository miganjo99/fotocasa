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

// function loadCategories() {
//     ajaxPromise('module/home/ctrl/ctrl_home.php?op=homePageCategory','GET', 'JSON')
//     .then(function(data) {
//         for (row in data) {
//             $('<div></div>').attr('class', "div_cate").attr({ 'id': data[row].name_cat }).appendTo('#containerCategories')
//                 .html(
//                     "<li class='portfolio-item'>" +
//                     "<div class='item-main'>" +
//                     "<div class='portfolio-image'>" +
//                     "<img src = " + data[row].img_cat + " alt='foto' </img> " +
//                     "</div>" +
//                     "<h5>" + data[row].name_cat + "</h5>" +
//                     "</div>" +
//                     "</li>"
//                 )
//         }
//     }).catch(function() {
//         window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Type_Categories HOME";
//     });
// }

// function loadCatTypes() {
//     ajaxPromise('module/home/ctrl/ctrl_home.php?op=homePageType','GET', 'JSON')
//     .then(function(data) {
//         for (row in data) {
//             $('<div></div>').attr('class', "div_motor").attr({ 'id': data[row].name_tmotor }).appendTo('#containerTypecar')
//                 .html(
//                     "<li class='portfolio-item2'>" +
//                     "<div class='item-main2'>" +
//                     "<div class='portfolio-image2'>" +
//                     "<img src = " + data[row].img_tmotor + " alt='foto'" +
//                     "</div>" +
//                     "<h5>" + data[row].name_tmotor + "</h5>" +
//                     "</div>" +
//                     "</li>"
//                 )

//         }
//     }).catch(function() {
//         window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Types_car HOME";
//     });
// }

$(document).ready(function() {
    carousel_tipo();
    // loadCategories();
    // loadCatTypes();
});