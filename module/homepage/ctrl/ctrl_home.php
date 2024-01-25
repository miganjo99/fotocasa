<?php
    $path = $_SERVER['DOCUMENT_ROOT'] . '/crud/crud_MVC/';
    include($path . "module/homepage/model/DAO_home.php");

    //$data = 'hola CTRL_HOME PHP';
    //die('<script>console.log('.json_encode( $data ) .');</script>');
   
    switch ($_GET['op']) {
        case 'list';
            //$data = 'hola Carrousel_tipo';
            //die('<script>console.log('.json_encode( $data ) .');</script>');
            include ('module/homepage/view/homepage.html');
        break;

        case 'Carrousel_tipo';
           
        
            //$data = 'hola Carrousel_tipo';
            //die('<script>console.log('.json_encode( $data ) .');</script>');
           
           
           
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

        // case 'homePageCategoria';
        //     try{
        //         $daohome = new DAOHome();
        //         $SelectCategory = $daohome->select_categorias();
        //     } catch(Exception $e){
        //         echo json_encode("error");
        //     }
            
        //     if(!empty($SelectCategory)){
        //         echo json_encode($SelectCategory); 
        //     }
        //     else{
        //         echo json_encode("error");
        //     }
        // break;

        // case 'homePageType';
        //     try{
        //         $daohome = new DAOHome();
        //         $SelectType = $daohome->select_type_motor();
        //     } catch(Exception $e){
        //         echo json_encode("error");
        //     }
            
        //     if(!empty($SelectType)){
        //         echo json_encode($SelectType); 
        //     }
        //     else{
        //         echo json_encode("error");
        //     }
        // break;

        // default;
        //     include("module/exceptions/views/pages/error404.php");
        // break;
    }
?>