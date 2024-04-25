<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/crud/crud_MVC/';
include($path . "module/shop/model/DAO_shop.php");
include($path . "model/middleware_auth.php");

@session_start();
if (isset($_SESSION["tiempo"])) {  
    $_SESSION["tiempo"] = time(); //Devuelve la fecha actual
}

// $data = 'hola crtl shop php';
// die('<script>console.log('.json_encode( $data ) .');</script>');

switch ($_GET['op']) {
    
    
    case 'list':
        include('module/shop/view/shop.html');
    break;

    case 'all_viviendas':
        // $data = $_POST['num_pages'];
        // die('<script>console.log('.json_encode( $data ) .');</script>');
        
        try {
            $daoshop = new DAOShop();
            $Dates_Viviendas = $daoshop->select_all_viviendas($_GET['offset'],$_GET['num_pages']);
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
        try {
            $daoshop_visit = new DAOShop();
            $Date_visit = $daoshop_visit->update_visit($_GET['id']);
        } catch (Exception $e) {
            echo json_encode("error");
        }

        if (!empty($Dates_Viviendas || $Date_images || $Date_visit)) {
            $rdo = array();
            $rdo[0] = $Dates_Viviendas;
            $rdo[1][] = $Date_images;
            $rdo[2][] = $Date_visit;
            echo json_encode($rdo);
        } else {
            echo json_encode("error");
        }
        break;

    case 'redirect_home';
        
        //echo json_encode($_POST['filters_home']);
        //break;
        
        $homeQuery = new DAOShop();
        $selSlide = $homeQuery -> redirect_home($_POST['filters_home'], $_POST['offset'], $_POST['num_pages']);
        
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

        //$data = $_POST['filters_shop'];
        //die('<script>console.log('.json_encode( $data ) .');</script>');

        $homeQuery = new DAOShop();
        $selSlide = $homeQuery -> filters($_POST['filters_shop'],$_POST['num_pages'],$_POST['offset']);

        if (!empty($selSlide)) {
            //echo "TENEMOS DATOS";
            echo json_encode($selSlide);
            //echo json_encode(array("success" => true, "data" => $selSlide));
        }else {
            //echo json_encode(array("success" => false, "message" => "No se encontraron datos disponibles."));
            echo "error";
        }

    break;
    
    case 'search';

        $homeQuery = new DAOShop();
        $selSlide = $homeQuery -> search($_POST['filters_search'],$_POST['offset'],$_POST['num_pages']);
        
        if (!empty($selSlide)) {
            echo json_encode($selSlide);
        }
        else {
            echo "error";
        }
    break;
    
    
    case 'likes';

        $homeQuery = new DAOShop();
        $selSlide = $homeQuery -> likes($_POST['acces_token'], $_POST['id_vivienda']);
        
        if (!empty($selSlide)) {
            echo json_encode($selSlide);
        }
        else {
            echo "error";
        }
    break;
    
    
    
    case 'mis_likes':
        $token = decode_token($_POST['acces_token']);
    
        $homeQuery = new DAOShop();
        $likes = $homeQuery->mis_likes($token['username']);
    
       
        if (!empty($likes)) {
            echo json_encode($likes); 
        } else {
            echo json_encode(["message" => "Este usuario no tiene likes"]); 
        }
    break;



    case 'filter_ult';
        
       
        try {
            $daoshop = new DAOShop();
            $Dates_Viviendas = $daoshop->filter_ult($_GET['ultima_busqueda']);
        } catch (Exception $e) {
            echo json_encode("error");
        }
        try {
            $daoshop_img = new DAOShop();
            $Date_images = $daoshop_img->filter_ult_img($_GET['ultima_busqueda']);
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
    
    case 'filtro_ordenar';
       
        try{
            $DAOShop = new DAOShop();
            $SelectOperation = $DAOShop->select_orden($_POST['filters_shop']);
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

    case 'filtro_orientacion';
        try{
            $DAOShop = new DAOShop();
            $SelectOrientacion = $DAOShop->select_orientacion();
        } catch(Exception $e){
            echo json_encode("error");
        }
        
        if(!empty($SelectOrientacion)){
            echo json_encode($SelectOrientacion); 
        }
        else{
            echo json_encode("error");
        }
    break;
    
    case 'count_shop';    
        $homeQuery = new DAOShop();
        $selSlide = $homeQuery -> count_shop($_POST['filters_shop']);
        if (!empty($selSlide)) {
            echo json_encode($selSlide);
        }
        else {
            echo "error";
        }
    break;
    case 'count_all';    
        $homeQuery = new DAOShop();
        $selSlide = $homeQuery -> count_all();
        if (!empty($selSlide)) {
            echo json_encode($selSlide);
        }
        else {
            echo "error";
        }
    break;

    case 'count_home';    
        $homeQuery = new DAOShop();
        $selSlide = $homeQuery -> count_home($_POST['filters_home']);
        if (!empty($selSlide)) {
            echo json_encode($selSlide);
        }
        else {
            echo "error";
        }
        break;
    
    case 'count_search';    
        $homeQuery = new DAOShop();
        $selSlide = $homeQuery -> count_search($_POST['filters_search']);
        if (!empty($selSlide)) {
            echo json_encode($selSlide);
        }
        else {
            echo "error";
        }
        break;

    case 'count_viviendas_related';    
        $homeQuery = new DAOShop();
        $selSlide = $homeQuery -> count_viviendas_related($_POST['related']);
        if (!empty($selSlide)) {
            echo json_encode($selSlide);
        }
        else {
            echo "error";
        }
    break;

    case 'viviendas_related';    
        $homeQuery = new DAOShop();
        $selSlide = $homeQuery -> viviendas_related($_POST['type'],$_POST['loaded'],$_POST['items']);
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
