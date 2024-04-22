function login() {
    if (validate_login() !== 0) {
        var data = [];
        data.push({ name: 'username_log', value: document.getElementById('username_log').value });
        data.push({ name: 'passwd_log', value: document.getElementById('passwd_log').value });

        console.log("Datos de inicio de sesión:", data);

        ajaxPromise('module/login/ctrl/ctrl_login.php?op=login', 'POST', 'JSON', data)
            .then(function(result) {
                console.log("Resultado del inicio de sesión:", result);

                if (result.status == "error_user") {
                    
                    document.getElementById('error_username_log').innerHTML = "El usuario no existe, asegúrese de que lo ha escrito correctamente";

                } else if (result.status == "error_passwd") {

                    document.getElementById('error_passwd_log').innerHTML = "La contraseña es incorrecta";

                } else if (result.status == "success") {
                    // Guardar ambos tokens en localStorage
                    localStorage.setItem("acces_token", result.acces_token);
                    localStorage.setItem("refresh_token", result.refresh_token);

                    toastr.success("Inicio de sesión exitoso");

                    // if (localStorage.getItem('redirect_like')) {
                    //     //  setTimeout(' window.location.href = "index.php?module=ctrl_shop&op=list"; ', 7000);
                    // }

                    setTimeout(' window.location.href = "index.php?module=ctrl_home&op=list"; ', 1500);

                }
            })
            .catch(function(textStatus) {
                console.log("La solicitud ha fallado:", textStatus);
            });
    }
}




function key_login() {
    $("#login").keypress(function(e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code == 13) {
            e.preventDefault();
            login();
        }
    });
}

function button_login() {
    $('#login').on('click', function(e) {
        e.preventDefault();
        login();
    });
}

function validate_login() {
    var error = false;

    if (document.getElementById('username_log').value.length === 0) {
        document.getElementById('error_username_log').innerHTML = "Tienes que escribir el usuario";
        error = true;
    } else {
        if (document.getElementById('username_log').value.length < 5) {
            document.getElementById('error_username_log').innerHTML = "El usuario tiene que tener 5 caracteres como minimo";
            error = true;
        } else {
            document.getElementById('error_username_log').innerHTML = "";
        }
    }

    if (document.getElementById('passwd_log').value.length === 0) {
        document.getElementById('error_passwd_log').innerHTML = "Tienes que escribir la contraseña";
        error = true;
    } else {
        document.getElementById('error_passwd_log').innerHTML = "";
    }

    if (error == true) {
        return 0;
    }
}

$(document).ready(function() {
    key_login();
    button_login();
});