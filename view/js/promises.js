function ajaxPromise(sUrl, sType, sTData, sData = undefined) {
    // alert(sUrl);
    // alert(sType);
    // alert(sTData);
    // alert(sData);

    return new Promise((resolve, reject) => {
        //console.log(data);

        //alert("entrando al return del ajax promise");
        $.ajax({
            url: sUrl,
            type: sType,
            dataType: sTData,
            data: sData 
            
        }).done((data) => {
            // console.log(data);
            // alert(data);
            resolve(data);
        }).fail((jqXHR, textStatus, errorThrow) => {
            // alert(".fail hola");
            // console.error("Error en la solicitud AJAX:", errorThrow);
            reject(errorThrow);
        });
    });
};
