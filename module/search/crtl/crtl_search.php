<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/crud/crud_MVC/';
include($path . "module/search/model/DAO_search.php");

switch ($_GET['op']) {
    case 'search_operacion';
     //echo json_encode("BREAK search ciudad");
     //break;
        $homeQuery = new DAOSearch();
        $selSlide = $homeQuery -> search_operacion();
        //echo json_encode($selSlide);
        

        if (!empty($selSlide)) {
            echo json_encode($selSlide);
        }
        else {
            echo "error";
        }
    break;
    

    case 'search_innovacion_null';
        $homeQuery = new DAOSearch();
        $selSlide = $homeQuery -> search_innovacion_null();
        if (!empty($selSlide)) {
            echo json_encode($selSlide);
        }
        else {
            echo "error";
        }
    break;

    case 'search_innovacion';
        $homeQuery = new DAOSearch();
        $selSlide = $homeQuery -> search_innovacion($_POST['operacion']);        
        if (!empty($selSlide)) {
            echo json_encode($selSlide);
        }
        else {
            echo "error";
        }
        break;

    case 'autocomplete';
    try{
        $dao = new DAOSearch();
        //echo json_encode("autocomplete");
        //break;
        $rdo = $dao->select_ciudad_innovacion($_POST['complete'], $_POST['operacion'], $_POST['innovacion']);
        
        
    }catch (Exception $e){
        echo json_encode("catch");
        exit;
    }
    if(!$rdo){
        echo json_encode("rdo!!!");
        exit;
    }else{
        $dinfo = array();
        foreach ($rdo as $row) {
            array_push($dinfo, $row);
        }
        echo json_encode($dinfo);
    }
    break; 
}