<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/crud/crud_MVC/';
include($path . "module/search/model/DAO_search.php");

switch ($_GET['op']) {
    case 'search_ciudad';
     //echo json_encode("BREAK search ciudad");
     //break;
        $homeQuery = new DAOSearch();
        $selSlide = $homeQuery -> search_ciudad();
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
        $selSlide = $homeQuery -> search_innovacion($_POST['ciudad']);        
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
        if (!empty($_POST['brand']) && empty($_POST['category'])){
            $rdo = $dao->select_only_brand($_POST['complete'], $_POST['brand']);
        }else if(!empty($_POST['brand']) && !empty($_POST['category'])){
            $rdo = $dao->select_brand_category($_POST['complete'], $_POST['brand'], $_POST['category']);
        }else if(empty($_POST['brand']) && !empty($_POST['category'])){
            $rdo = $dao->select_only_category($_POST['category'], $_POST['complete']);
        }else {
            $rdo = $dao->select_city($_POST['complete']);
        }
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