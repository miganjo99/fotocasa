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
        
       // echo json_encode("Hola");
       // break;

        $homeQuery = new DAOShop();
        $selSlide = $homeQuery -> filters($_POST['filters_shop']);
        
        if (!empty($selSlide)) {
            echo json_encode($selSlide);
        }
        else {
            echo "error";
        }
    break;


    case 'filtro_tipo';
    try{
        $daohome = new DAOShop();
        $SelectTipo = $daohome->select_tipo();
    } catch(Exception $e){
        echo json_encode("error");
    }
    
    if(!empty($SelectTipo)){
        echo json_encode($SelectTipo); 
    }
    else{
        echo json_encode("error");
    }
    break;

    case 'filtro_categoria';
        try{
            $DAOShop = new DAOShop();
            $SelectCategory = $DAOShop->select_categorias();
        } catch(Exception $e){
            echo json_encode("error");
        }
        
        if(!empty($SelectCategory)){
            echo json_encode($SelectCategory); 
        }
        else{
            echo json_encode("error");
        }
    break;

    case 'filtro_operacion';
        try{
            $DAOShop = new DAOShop();
            $SelectOperation = $DAOShop->select_operacion();
        } catch(Exception $e){
            echo json_encode("error");
        }
        
        if(!empty($SelectOperation)){
            echo json_encode($SelectOperation); 
        }
        else{
            echo json_encode("error");
        }
    break;

    case 'filtro_ciudad';
        try{
            $DAOShop = new DAOShop();
            $SelectCity = $DAOShop->select_ciudad();
        } catch(Exception $e){
            echo json_encode("error");
        }
        
        if(!empty($SelectCity)){
            echo json_encode($SelectCity); 
        }
        else{
            echo json_encode("error");
        }
    break;



    // case 'filtrosdinamicos';
        
       

    //     $homeQuery = new DAOShop();
    //     $selSlide = $homeQuery -> filtrosdinamicos();
        
    //     if (!empty($selSlide)) {
    //         echo json_encode($selSlide);
    //     }
    //     else {
    //         echo "error";
    //     }
    // break;



    default;
        //include("module/exceptions/views/pages/error404.php");
        break;
}
