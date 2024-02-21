<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/crud/crud_MVC/';
include($path . "module/shop/model/DAO_shop.php");

// $data = 'hola crtl shop php';
// die('<script>console.log('.json_encode( $data ) .');</script>');

switch ($_GET['op']) {
    
    
    case 'list':
        include('module/shop/view/shop.html');
    break;

    case 'all_viviendas':
        //$data = 'hola all_viviendas php';
        //die('<script>console.log('.json_encode( $data ) .');</script>');
        
        try {
            $daoshop = new DAOShop();
            $Dates_Viviendas = $daoshop->select_all_viviendas();
            //die('<script>console.log('.json_encode( $daoshop ) .');</script>');
        } catch (Exception $e) {
            echo json_encode("error");
        }

        if (!empty($Dates_Viviendas)) {
            echo json_encode($Dates_Viviendas);
        } else {
            echo json_encode("error all viviendas ctrl_shop php");
        }
        break;

    case 'details_vivienda':
        try {
            $daoshop = new DAOShop();
            $Dates_Viviendas = $daoshop->select_one_vivienda($_GET['id']);
        } catch (Exception $e) {
            echo json_encode("error");
        }
        try {
            $daoshop_img = new DAOShop();
            $Date_images = $daoshop_img->select_imgs_vivienda($_GET['id']);
        } catch (Exception $e) {
            echo json_encode("error");
        }

        if (!empty($Dates_Viviendas || $Date_images)) {
            $rdo = array();
            $rdo[0] = $Dates_Viviendas;
            $rdo[1][] = $Date_images;
            echo json_encode($rdo);
        } else {
            echo json_encode("error");
        }
        break;

    case 'redirect_home';
        //echo json_encode($_POST['filtros']);
        //break;
        $homeQuery = new DAOShop();
        $selSlide = $homeQuery -> redirect_home($_POST['filters_home']);
        
        if (!empty($selSlide)) {
            echo json_encode($selSlide);
        }
        else {
            echo "error";
        }
    break;

    case 'list_vivienda_array':
        try {
            $daoshop = new DAOShop();
            $Dates_Viviendas = $daoshop->select_one_vivienda($_GET['id']);
        } catch (Exception $e) {
            echo json_encode("error");
        }
        try {
            $daoshop_img = new DAOShop();
            $Date_images = $daoshop_img->select_imgs_vivienda($_GET['id']);
        } catch (Exception $e) {
            echo json_encode("error");
        }

        if (!empty($Dates_Viviendas || $Date_images)) {
            $rdo = array();
            $rdo[0] = $Dates_Viviendas;
            $rdo[1][] = $Date_images;
            echo json_encode($rdo);
        } else {
            echo json_encode("error");
        }
        break;


    case 'filter';
        //echo json_encode($_POST['filters_shop']);
        //break;
        $homeQuery = new DAOShop();
        $selSlide = $homeQuery -> filters($_POST['filters_shop']);
        if (!empty($selSlide)) {
            echo json_encode($selSlide);
        }
        else {
            echo "error";
        }
    break;



    default;
        //include("module/exceptions/views/pages/error404.php");
        break;
}
