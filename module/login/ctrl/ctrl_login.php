<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/crud/crud_MVC/';
include($path . "module/login/model/DAO_login.php");
 include($path . "model/middleware_auth.php");
 @session_start();
// if (isset($_SESSION["tiempo"])) {  
//     $_SESSION["tiempo"] = time(); //Devuelve la fecha actual
// }//NO TRACKEAR EN EL CTRL_LOGIN PQ SINO ACTUALIZA TODO EL TIEMPO EL $SESSION

switch ($_GET['op']) {
    case 'login-register_view';
        include("module/login/view/login-register.html");
        
        break;

    case 'register':
        // Comprobar que la email no exista
        try {
            $daoLog = new DAOLogin();
            $check = $daoLog->select_email($_POST['email_reg']);
        } catch (Exception $e) {
            echo json_encode("error");
            exit;
        }

        if ($check) {
            $check_email = false;
        } else {
            $check_email = true;
        }

        // Si no existe el email creará el usuario
        if ($check_email) {
            try {
                $daoLog = new DAOLogin();
                $rdo = $daoLog->insert_user($_POST['username_reg'], $_POST['email_reg'], $_POST['passwd1_reg']);
            } catch (Exception $e) {
                echo json_encode("error");
                exit;
            }
            if (!$rdo) {
                echo json_encode("error_user");
                exit;
            } else {
                echo json_encode("ok");
                exit;
            }
        } else {
            echo json_encode("error_email");
            exit;
        }
        break;

    case 'login':
        try {
            $daoLog = new DAOLogin();
            $rdo = $daoLog->select_user($_POST['username_log']);
    
            if ($rdo == "error_user") {
                echo json_encode(["status" => "error_user"]);
                exit;
            } else {
                if (password_verify($_POST['passwd_log'], $rdo['password'])) {
                    $acces_token = create_acces_token($rdo["username"]);
                    $refresh_token = create_refresh_token($rdo["username"]);
    
                    $_SESSION['username'] = $rdo['username']; 
                    $_SESSION['tiempo'] = time(); 
    
                    // Devuelve ambos tokens como parte de un objeto JSON
                    echo json_encode([
                        "status" => "success",
                        "acces_token" => $acces_token,
                        "refresh_token" => $refresh_token
                    ]);
                    exit;
                } else {
                    echo json_encode(["status" => "error_passwd"]);
                    exit;
                }
            }
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            exit;
        }
        break;
    
    case 'logout':
        unset($_SESSION['username']);
        unset($_SESSION['tiempo']);
        session_destroy();

        echo json_encode('Done');
        break;

    case 'data_user':


        $json = decode_token($_POST['acces_token']);

        // echo json_encode($json);
        // exit;
        // break;

        $daoLog = new DAOLogin();
        $rdo = $daoLog->select_data_user($json['username']);
        echo json_encode($rdo);
        exit;
        break;

    case 'actividad':

        // echo json_encode($_SESSION["tiempo"]); //= 1713376073
        // echo json_encode(time()); //= 1713376099
        //  exit();

        if (!isset($_SESSION["tiempo"])) {
            echo json_encode("inactivo");
            exit();
        } else {
            //if ((time() - $_SESSION["tiempo"]) >= 1800) { //1800=30min//Aqui pones el tiempo que quieres que dure las sesion
            //if ((time() - $_SESSION["tiempo"]) >= 100) { //100=30seg//Aqui pones el tiempo que quieres que dure las sesion
            if ((time() - $_SESSION["tiempo"]) >= 100) { //100=30seg//Aqui pones el tiempo que quieres que dure las sesion
                //1713374920
                echo json_encode("inactivo");
                exit();
            } else {
                echo json_encode("activo");
                exit();
            }
        }
        break;

    case 'controluser':
        //$token_dec = decode_token($_POST['token']);

        $token_acc = decode_token($_POST['acces_token']);
        $token_ref = decode_token($_POST['refresh_token']);
        

        //  echo json_encode($_POST['refresh_token']);
        //  exit();

        // if ($token_dec['exp'] < time()) {
        //     echo json_encode("Wrong_User");
        //     exit();
        // }
        if ($token_acc['exp'] < time()) {
            echo json_encode("Wrong_User");
            exit();
        }

        if ($token_acc['exp'] >= time() && $token_ref['exp'] < time()) {
            $old_token = decode_token($_POST['acces_token']);
            $new_token = create_token($old_token['username']);
            //echo json_encode($new_token);            
            echo json_encode("Correct_User");            
            exit();
        }
        
        if (isset($_SESSION['username']) && ($_SESSION['username']) == $token_acc['username']) {
            echo json_encode("Correct_User");
            exit();
        } else {
            echo json_encode("Wrong_User");
            exit();
        }
        break;

    // case 'refresh_token':
    //     $old_token = decode_token($_POST['token']);
    //     $new_token = create_token($old_token['username']);
    //     echo json_encode($new_token);
    // break;

    case 'refresh_cookie':
        session_regenerate_id();
        echo json_encode("Done");
        exit;
        break;

    default;
        include("module/exceptions/views/pages/error404.php");
        break;
}
