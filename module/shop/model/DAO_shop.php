<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/crud/crud_MVC/';
include($path . "model/connect.php");

// $datos="select all viviendas die";
// die('<script>console.log('.json_encode( $datos ) .');</script>');


class DAOShop{

	function redirect_home($filters_home){
		//return $filtros;


        // $select = "SELECT *
		// FROM vivienda v, ciudad c, categoria ca, tipo t, operacion o
		// WHERE v.id_ciudad = c.id_ciudad 
		// AND v.id_categoria = ca.id_categoria
		// AND v.id_tipo = t.id_tipo
		// AND v.id_operacion = o.id_operacion";

		$select = "SELECT *
		FROM vivienda v
		WHERE";

		
        if (isset($filters_home[0]['tipo'])){
            $prueba = $filters_home[0]['tipo'][0];
            $select.= " v.id_tipo = '$prueba'";
        }
		else if (isset($filters_home[0]['categoria'])) {
            $prueba = $filters_home[0]['categoria'][0];
            $select.= " v.id_categoria = '$prueba'";
        }
		else if (isset($filters_home[0]['operacion'])) {
            $prueba = $filters_home[0]['operacion'][0];
            $select.= " v.id_operacion = '$prueba'";
        }
        else if (isset($filters_home[0]['ciudad'])) {
            $prueba = $filters_home[0]['ciudad'][0];
            $select.= " v.id_ciudad = '$prueba'";
        }
        
        
        //////////$select.= " LIMIT $total_prod, $items_page";
       
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

	function select_all_viviendas(){
		
		$sql = "SELECT * 
		FROM vivienda v  
		ORDER BY v.id_vivienda DESC;";

		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);

		$retrArray = array();
		if (mysqli_num_rows($res) > 0) {
			while ($row = mysqli_fetch_assoc($res)) {
				$retrArray[] = $row;
			}
		}
		return $retrArray;
	}
	
	function select_all_viviendas_array(){
		
		$sql = "SELECT v.*, i.img_vivienda
		FROM vivienda v, img_vivienda i
		WHERE i.id_vivienda=v.id_vivienda
		ORDER BY v.id_vivienda;";

		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);

		$retrArray = array();
		if (mysqli_num_rows($res) > 0) {
			while ($row = mysqli_fetch_assoc($res)) {
				$retrArray[] = $row;
			}
		}
		return $retrArray;
	}
	

	function filters($filters_shop){
       
		//return "Hola DAOOOOOOOOOOOO";
		//return $filters_shop;
		    
        // $consulta = "SELECT v.*
		// FROM vivienda v, ciudad c, categoria ca, tipo t, operacion o, img_vivienda i
		// WHERE v.id_ciudad = c.id_ciudad 
		// AND v.id_categoria = ca.id_categoria
		// AND v.id_tipo = t.id_tipo
		// AND v.id_operacion = o.id_operacion";


        $consulta = "SELECT DISTINCT v.*
		FROM vivienda v, ciudad c, categoria ca, tipo t, operacion o, img_vivienda i";
		//return $consulta;
            for ($i=0; $i < count($filters_shop); $i++){
                if ($i==0){
                    $consulta.= " WHERE v." . $filters_shop[$i][0] . "=" . $filters_shop[$i][1]; 
                }else {
                    $consulta.= " AND v." . $filters_shop[$i][0] . "=" . $filters_shop[$i][1];
                }        
                // else if{
                //     $consulta.= " AND v." . $filters_shop[$i][0] .  ">=" . $filters_shop[$i][1];
                // }        
                // else if{
                //     $consulta.= " AND v." . $filters_shop[$i][0] .  "<=" . $filters_shop[$i][1];
                // }        
			}    
			//return $filters_shop;
        $conexion = connect::con();
        $res = mysqli_query($conexion, $consulta);
        connect::close($conexion);

        $retrArray = array();
        if ($res -> num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $retrArray[] = $row;
            }
        }
        return $retrArray;
    }


	function select_tipo() {
		$sql= "SELECT * FROM tipo ORDER BY id_tipo ASC;";

		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);

		$retrArray = array();
		if (mysqli_num_rows($res) > 0) {
			while ($row = mysqli_fetch_assoc($res)) {
				$retrArray[] = $row;
			}
		}
		return $retrArray;
	}

	function select_categorias() {
		$sql= "SELECT *FROM categoria ORDER BY id_categoria ASC";

		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);

		$retrArray = array();
		if (mysqli_num_rows($res) > 0) {
			while ($row = mysqli_fetch_assoc($res)) {
				$retrArray[] = $row;
			}
		}
		return $retrArray;
	}

	function select_operacion() {
		$sql= "SELECT *FROM operacion ORDER BY id_operacion ASC";

		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);

		$retrArray = array();
		if (mysqli_num_rows($res) > 0) {
			while ($row = mysqli_fetch_assoc($res)) {
				$retrArray[] = $row;
			}
		}
		return $retrArray;
	}

	function select_ciudad() {
		$sql= "SELECT * FROM ciudad ORDER BY id_ciudad ASC";

		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);

		$retrArray = array();
		if (mysqli_num_rows($res) > 0) {
			while ($row = mysqli_fetch_assoc($res)) {
				$retrArray[] = $row;
			}
		}
		return $retrArray;
	}


	function filtrosdinamicos(){
		
		$sql = "SELECT *
		FROM vivienda v, ciudad c, categoria ca, tipo t, operacion o		
		WHERE  v.id_ciudad = c.id_ciudad 
		AND v.id_categoria = ca.id_categoria
		AND v.id_tipo = t.id_tipo
		AND v.id_operacion = o.id_operacion
		GROUP BY o.id_operacion";



		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);

		$retrArray = array();
		if (mysqli_num_rows($res) > 0) {
			while ($row = mysqli_fetch_assoc($res)) {
				$retrArray[] = $row;
			}
		}
		return $retrArray;
	}

	function select_one_vivienda($id){
		$sql = "SELECT *
		FROM vivienda v, ciudad c, categoria ca, tipo t, operacion o
		WHERE v.id_vivienda = '$id'
		AND  v.id_ciudad = c.id_ciudad 
		AND v.id_categoria = ca.id_categoria
		AND v.id_tipo = t.id_tipo
		AND v.id_operacion = o.id_operacion";

		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql)->fetch_object();
		connect::close($conexion);

		return $res;
	}

	function select_imgs_vivienda($id){
		$sql = "SELECT i.id_vivienda, i.img_vivienda
			    FROM img_vivienda i
			    WHERE i.id_vivienda = '$id'";

		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);

		$imgArray = array();
		if (mysqli_num_rows($res) > 0) {
			foreach ($res as $row) {
				array_push($imgArray, $row);
			}
		}
		return $imgArray;
	}


	function select_imgs_vivienda_array($id){
		$sql = "SELECT DISTINCT i.img_vivienda
		FROM img_vivienda i, vivienda v
		WHERE v.id_img = i.id_vivienda AND v.id_img=$id";

		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);

		$imgArray = array();
		if (mysqli_num_rows($res) > 0) {
			foreach ($res as $row) {
				array_push($imgArray, $row);
			}
		}
		return $imgArray;
	}
}
