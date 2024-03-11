<?php
    $path = $_SERVER['DOCUMENT_ROOT'] . '/crud/crud_MVC/';
    include($path . "model/connect.php");

    class DAOSearch {

        function search_ciudad(){
            //echo json_encode("HOLA DAO");
            

            $select="SELECT * FROM ciudad";
            //return $select;
            $conexion = connect::con();
            $res = mysqli_query($conexion, $select);
            connect::close($conexion);
            
            $retrArray = array();
            if ($res -> num_rows > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $retrArray[] = $row;
                }
            }
            return $retrArray;
        }

        function search_innovacion_null(){
            $select="SELECT DISTINCT * FROM innovacion";
            
            $conexion = connect::con();
            $res = mysqli_query($conexion, $select);
            connect::close($conexion);
            
            $retrArray = array();
            if ($res -> num_rows > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $retrArray[] = $row;
                }
            }
            return $retrArray;
        }

        function search_innovacion($ciudad){
            $select="SELECT i.*
            FROM vivienda v, innovacion i
            WHERE i.id_innovacion = v.id_innovacion AND v.id_ciudad = '$ciudad'";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $select);
            connect::close($conexion);

            $retrArray = array();
            if ($res -> num_rows > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $retrArray[] = $row;
                }
            }
            return $retrArray;
        }

        function select_only_brand($complete, $brand){
            $select="SELECT *
            FROM car c
            WHERE marca = '$brand' AND city LIKE '$complete%'";
            
            $conexion = connect::con();
            $res = mysqli_query($conexion, $select);
            connect::close($conexion);
            
            $retrArray = array();
            if ($res -> num_rows > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $retrArray[] = $row;
                }
            }
            return $retrArray;
        }

        function select_only_category($category, $complete){
            $select="SELECT *
            FROM car c
            WHERE categoria = '$category' AND city LIKE '$complete%'";
            
            $conexion = connect::con();
            $res = mysqli_query($conexion, $select);
            connect::close($conexion);
            
            $retrArray = array();
            if ($res -> num_rows > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $retrArray[] = $row;
                }
            }
            return $retrArray;
        }


        function select_brand_category($complete, $brand, $category){
            $select="SELECT *
            FROM car c
            WHERE c.marca = '$brand' AND c.categoria = '$category' AND c.city LIKE '$complete%'";
            
            $conexion = connect::con();
            $res = mysqli_query($conexion, $select);
            connect::close($conexion);
            
            $retrArray = array();
            if ($res -> num_rows > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $retrArray[] = $row;
                }
            }
            return $retrArray;
        }

        function select_city($complete){
            $select="SELECT *
            FROM car c
            WHERE c.city LIKE '$complete%'";
            
            $conexion = connect::con();
            $res = mysqli_query($conexion, $select);
            connect::close($conexion);
            
            $retrArray = array();
            if ($res -> num_rows > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $retrArray[] = $row;
                }
            }
            return $retrArray;
        }
    }