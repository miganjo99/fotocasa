<?php
    $path = $_SERVER['DOCUMENT_ROOT'] . '/crud/crud_MVC/';
    include($path . "model/connect.php");

    class DAOSearch {

        function search_operacion(){
            //echo json_encode("HOLA DAO");
            

            $select="SELECT * FROM operacion";
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

        function search_innovacion($operacion){
            $select="SELECT DISTINCT i.*
            FROM vivienda v, innovacion i
            WHERE i.id_innovacion = v.id_innovacion AND v.id_operacion = '$operacion'";

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

    


        function select_ciudad_innovacion($complete, $operacion, $innovacion){
            $select="SELECT DISTINCT c.name_ciudad
            FROM vivienda v, operacion o, innovacion i, ciudad c
            WHERE v.id_operacion = o.id_operacion
            AND v.id_innovacion = i.id_innovacion
            AND v.id_ciudad = c.id_ciudad ";

            if (empty($complete) && !empty($operacion) && empty($innovacion)){

                $select .= "AND v.id_operacion = $operacion ;";
             }
            else if (empty($complete) && empty($operacion) && !empty($innovacion)){
 
                $select .= " AND v.id_innovacion = $innovacion ;";
             }
            else if (empty($complete) && !empty($operacion) && !empty($innovacion)){

                $select .= "AND v.id_operacion = $operacion AND v.id_innovacion = $innovacion ;";
             }
            else if (!empty($complete) && empty($operacion) && !empty($innovacion)){

                $select .= "AND v.id_innovacion= $innovacion AND c.name_ciudad LIKE '$complete%' ;";
             }
            else if (!empty($complete) && !empty($operacion) && empty($innovacion)){

                $select .= "AND v.id_operacion = $operacion AND c.name_ciudad LIKE '$complete%' ;";
             }
            else if(!empty($complete) && empty($operacion) && empty($innovacion)){

                $select .= " AND c.name_ciudad LIKE '$complete%' ;";
             }
            
            
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