function load_ciudad() {
    //console.log("HOLA LOAD CIUDAD SEARCH");
    //alert("uep");
    ajaxPromise('module/search/crtl/crtl_search.php?op=search_ciudad', 'POST', 'JSON')
    .then(function (data) {
        //console.log(".THEEEEEEEEEEEEEEEEEEN",data);
        //alert("hola promise");
        $('<option>Ciudad</option>').attr('selected', true).attr('disabled', true).appendTo('.search_ciudad')
        for (row in data) {
            $('<option value="' + data[row].id_ciudad + '">' + data[row].name_ciudad + '</option>').appendTo('.search_ciudad')
        }
    }).catch(function () {
        //  window.location.href = "index.php?modules=exception&op=503&error=fail_load_category&type=503";
    });
}

function load_innovacion(ciudad) {
    $('.search_innovacion').empty();

    if (ciudad == undefined) {
        ajaxPromise('module/search/crtl/crtl_search.php?op=search_innovacion_null', 'POST', 'JSON')
            .then(function (data) {
                $('<option>Innovacion</option>').attr('selected', true).attr('disabled', true).appendTo('.search_innovacion')
                for (row in data) {
                    $('<option value="' + data[row].id_innovacion + '">' + data[row].name_innovacion + '</option>').appendTo('.search_innovacion')
                }
            }).catch(function () {
                //window.location.href = "index.php?modules=exception&op=503&error=fail_load_innovacion&type=503";
            });
    }
    else {
        ajaxPromise('module/search/crtl/crtl_search.php?op=search_innovacion', 'POST', 'JSON', ciudad)
            .then(function (data) {
                for (row in data) {
                    $('<option value="' + data[row].id_innovacion + '">' + data[row].name_innovacion + '</option>').appendTo('.search_innovacion')
                }
            }).catch(function () {
                //window.location.href = "index.php?modules=exception&op=503&error=fail_load_innovacion_2&type=503";
            });
    }
}

function launch_search() {
    load_ciudad();
    load_innovacion();
    $(document).on('change', '.search_ciudad', function () {
        let ciudad = $(this).val();
        console.log("ciudad:",ciudad);
        if (ciudad === 0) {
            load_innovacion();
        } else {
            load_innovacion({ ciudad });
        }
    });
}

function autocomplete() {
    $("#autocom").on("keyup", function () {
        let sdata = { complete: $(this).val() };
        if (($('.search_brand').val() != 0)) {
            sdata.brand = $('.search_brand').val();
            if (($('.search_brand').val() != 0) && ($('.search_category').val() != 0)) {
                sdata.category = $('.search_category').val();
            }
        }
        if (($('.search_brand').val() == undefined) && ($('.search_category').val() != 0)) {
            sdata.category = $('.search_category').val();
        }
        ajaxPromise('modules/search/crtl/crtl_search.php?op=autocomplete', 'POST', 'JSON', sdata)
            .then(function (data) {
                $('#searchAuto').empty();
                $('#searchAuto').fadeIn(10000000);
                for (row in data) {
                    $('<div></div>').appendTo('#search_auto').html(data[row].city).attr({ 'class': 'searchElement', 'id': data[row].city });
                }
                $(document).on('click', '.searchElement', function () {
                    $('#autocom').val(this.getAttribute('id'));
                    $('#search_auto').fadeOut(1000);
                });
                $(document).on('click scroll', function (event) {
                    if (event.target.id !== 'autocom') {
                        $('#search_auto').fadeOut(1000);
                    }
                });
            }).catch(function () {
                $('#search_auto').fadeOut(500);
            });
    });
}

function button_search() {
    $('#search-btn').on('click', function () {
        var search = [];
        
        if ($('.search_brand').val() != undefined) {
            search.push({ "brand": [$('.search_brand').val()] })
            if ($('.search_category').val() != undefined) {
                search.push({ "category": [$('.search_category').val()] })
            }
            if ($('#autocom').val() != undefined) {
                search.push({ "city": [$('#autocom').val()] })
            }
        } else if ($('.search_brand').val() == undefined) {
            if ($('.search_category').val() != undefined) {
                search.push({ "category": [$('.search_category').val()] })
            }
            if ($('#autocom').val() != undefined) {
                search.push({ "city": [$('#autocom').val()] })
            }
        }
        localStorage.removeItem('filters_search');
        if (search.length != 0) {
            localStorage.setItem('filters_search', JSON.stringify(search));
        }
        window.location.href = 'index.php?modules=shop&op=list';
    });
}

$(document).ready(function () {
    launch_search();
    //autocomplete();
    //button_search();
});