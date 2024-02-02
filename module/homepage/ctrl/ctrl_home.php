<?php
    $path = $_SERVER['DOCUMENT_ROOT'] . '/crud/crud_MVC/';
    include($path . "module/homepage/model/DAO_home.php");


   
    switch ($_GET['op']) {
        case 'list';
  
            include ('module/homepage/view/homepage.html');
        break;

        case 'Carrousel_tipo';
            try{
                $daohome = new DAOHome();
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

        case 'homePageCategoria';
            try{
                $daohome = new DAOHome();
                $SelectCategory = $daohome->select_categorias();
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

        case 'homePageOperacion';
            try{
                $daohome = new DAOHome();
                $SelectOperation = $daohome->select_operacion();
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

        case 'homePageCiudad';
            try{
                $daohome = new DAOHome();
                $SelectCity = $daohome->select_ciudad();
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

        case 'homePageRecomendaciones';
            try{
                $daohome = new DAOHome();
                $SelectVivienda = $daohome->select_vivienda();
            } catch(Exception $e){
                echo json_encode("error");
            }
            
            if(!empty($SelectVivienda)){
                echo json_encode($SelectVivienda); 
            }
            else{
                echo json_encode("error");
            }
        break;

        // default;
        //     include("module/exceptions/views/pages/error404.php");
        // break;
    }
?>