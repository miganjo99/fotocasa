<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/crud/crud_MVC/';
include($path . "model/connect.php");

// $datos="select all viviendas die";
// die('<script>console.log('.json_encode( $datos ) .');</script>');


class DAOShop{
	
	function redirect_home($filters_home, $offset, $num_pages) {
		$select = "SELECT * FROM vivienda v WHERE";
		//echo "******************************";
		//echo $filters_home[0];
		//echo "******************************";
		//return $filters_home;
		foreach ($filters_home as &$value) {
			//foreach($value as &$value_parsed){
			foreach ($value as $value_parsed) {
				if (isset($value_parsed['categoria'])) {
					$prueba = $value_parsed['categoria'][0];
					$select .= " v.id_categoria = '$prueba'";
				} elseif (isset($value_parsed['tipo'])) {
					$prueba = $value_parsed['tipo'][0];
					$select .= " v.id_tipo = '$prueba'";
				} elseif (isset($value_parsed['operacion'])) {
					$prueba = $value_parsed['operacion'][0];
					$select .= " v.id_operacion = '$prueba'";
				} elseif (isset($value_parsed['ciudad'])) {
					$prueba = $value_parsed['ciudad'][0];
					$select .= " v.id_ciudad = '$prueba'";
				}
			}
		
		}	
		$select .= " LIMIT $offset, $num_pages";
	
		$conexion = connect::con();
		$res = mysqli_query($conexion, $select);
		connect::close($conexion);
	
		$retrArray = array();
		if ($res->num_rows > 0) {
			while ($row = mysqli_fetch_assoc($res)) {
				$retrArray[] = $row;
			}
		}
		return $retrArray;
	}
	

	function select_all_viviendas($offset, $num_pages ){
		
		$sql = "SELECT * 
		FROM vivienda v  
		ORDER BY v.id_vivienda ASC
		LIMIT  $offset, $num_pages;";

		//return $sql;

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

	function select_orden($filters_shop){
		
		
		$consulta = "SELECT DISTINCT v.*
		FROM vivienda v, ciudad c, categoria ca, tipo t, operacion o, img_vivienda i";
		//return $consulta;
		
		if ($filters_shop[0][0] == 'precio') {
				//echo json_encode("*********************");
				//return false;
	
				if ($filters_shop[0][1] == 1) {
					$consulta .=  " ORDER BY v.precio ASC";
				} elseif ($filters_shop[0][1] == 2) {
					$consulta .= " ORDER BY v.precio DESC";
				}
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
		
		
		
		
		
		
		
		
		// $sql = "SELECT * 
		// FROM vivienda v";

		// if ($filters_shop[0][0] == 'precio') {
		// 	//echo json_encode("*********************");
		// 	//return false;

		// 	if ($filters_shop[0][1] == 1) {
		// 		$sql .=  " ORDER BY v.precio ASC";
		// 	} elseif ($filters_shop[0][1] == 2) {
		// 		$sql .= " ORDER BY v.precio DESC";
		// 	}
		// }



		// $conexion = connect::con();
		// $res = mysqli_query($conexion, $sql);
		// connect::close($conexion);

		// $retrArray = array();
		// if (mysqli_num_rows($res) > 0) {
		// 	while ($row = mysqli_fetch_assoc($res)) {
		// 		$retrArray[] = $row;
		// 	}
		// }
		// return $retrArray;
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
	

	function filters($filters_shop, $num_pages, $offset){


		

        $consulta = "SELECT DISTINCT v.*
		FROM vivienda v, ciudad c, categoria ca, tipo t, operacion o, img_vivienda i";
		//return $consulta;
		
		$index = 0;
		foreach ($filters_shop as &$value) {
			foreach($value as &$value_parsed){
				// [id_operacion : 2]
				//echo " nombre: ";
				//echo $value_parsed[0];
				//echo " id: ";
				//echo $value_parsed[1];
 

				if ($index == 0 ) {
					$consulta .= " WHERE v." . $value_parsed[0] . "=" . $value_parsed[1]; 
				} else {
					$consulta .= " AND v." . $value_parsed[0] . "=" . $value_parsed[1];
				}
				
				


				$index++;
			}
		}


		/*
		for ($i = 0; $i < count($filters_shop); $i++) {
			if ($i == 0 ) {
				$consulta .= " WHERE v." . $filters_shop[$i][0] . "=" . $filters_shop[$i][1]; 
			} else {
				$consulta .= " AND v." . $filters_shop[$i][0] . "=" . $filters_shop[$i][1];
			}
			
		}   */

		$consulta.= " LIMIT  $offset, $num_pages ";

		
		//return $consulta;

        $conexion = connect::con();
        $res = mysqli_query($conexion, $consulta);
        connect::close($conexion);

        $retrArray = array();
        if ($res -> num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
				$retrArray[] = $row;
            }
        }else{
			
		}
        return $retrArray;
    }
	
	function search($filters_search, $offset, $num_pages){
       
		

		//return $filters_search;

        $consulta = "SELECT v.*
		FROM vivienda v, ciudad c, innovacion i
		WHERE v.id_innovacion = i.id_innovacion
		AND v.id_ciudad = c.id_ciudad ";
		
		foreach ($filters_search as &$value) {
			foreach ($value as $value_parsed) {
				//return $value_parsed['id_operacion'][0];
				if (!empty($value_parsed['id_operacion'][0])) {
					$consulta .= " AND v.id_operacion = " . ($value_parsed['id_operacion'][0]);
				}
				elseif (!empty($value_parsed['id_innovacion'][0])) {
					$consulta .= " AND v.id_innovacion = " . ($value_parsed['id_innovacion'][0]);
				}
				elseif (!empty($value_parsed['ciudad'][0])) {
					$consulta .= " AND c.name_ciudad = '" . $value_parsed['ciudad'][0] . "'";
				}
			}
		}

		$consulta.= " LIMIT $offset, $num_pages";
		//return $consulta;


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

	function filter_ult($ultima_busqueda){
       

        $sql = "SELECT *
		FROM vivienda v, ciudad c, categoria ca, tipo t, operacion o
		WHERE v.id_vivienda = '$ultima_busqueda'
		AND  v.id_ciudad = c.id_ciudad 
		AND v.id_categoria = ca.id_categoria
		AND v.id_tipo = t.id_tipo
		AND v.id_operacion = o.id_operacion";

		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql)->fetch_object();
		connect::close($conexion);

		return $res;
    }
	
	function filter_ult_img($ultima_busqueda){
		$sql = "SELECT i.id_vivienda, i.img_vivienda
			    FROM img_vivienda i
			    WHERE i.id_vivienda = '$ultima_busqueda'";

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

	function select_orientacion() {
		$sql= "SELECT *FROM orientacion ORDER BY id_orientacion ASC";

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

	function count_shop($filters_shop){

		$consulta = "SELECT DISTINCT COUNT(v.id_vivienda) contador
		FROM vivienda v, ciudad c, categoria ca, tipo t, operacion o 
		WHERE v.id_ciudad=c.id_ciudad
		AND v.id_categoria=ca.id_categoria
		AND v.id_tipo=t.id_tipo
		AND v.id_operacion=o.id_operacion";

		for ($i = 0; $i < count($filters_shop); $i++) {
			if ($i == 0 ) {
				$consulta .= " AND v." . $filters_shop[$i][0] . "=" . $filters_shop[$i][1]; 
			} else {
				$consulta .= " AND v." . $filters_shop[$i][0] . "=" . $filters_shop[$i][1];
			}
			
		}   
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
	function count_search($filters_search){
       
		
        $consulta = "SELECT DISTINCT COUNT(v.id_vivienda) contador
		FROM vivienda v, ciudad c, innovacion i
		WHERE v.id_innovacion = i.id_innovacion
		AND v.id_ciudad = c.id_ciudad ";
		
		
		for ($i = 0; $i < count($filters_search); $i++) {
			if (!empty($filters_search[$i]['id_operacion'][0])) {
				$consulta .= " AND v.id_operacion = " . ($filters_search[$i]['id_operacion'][0]);
			}
			elseif (!empty($filters_search[$i]['id_innovacion'][0])) {
				$consulta .= " AND v.id_innovacion = " . ($filters_search[$i]['id_innovacion'][0]);
			}
			elseif (!empty($filters_search[$i]['ciudad'][0])) {
				$consulta .= " AND c.name_ciudad = '" . $filters_search[$i]['ciudad'][0] . "'";
			}
		}
		//return $consulta;


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

	function count_home($filters_home){
		
		$select = "SELECT DISTINCT COUNT(v.id_vivienda) contador
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


	function count_all(){

		$consulta = "SELECT DISTINCT COUNT(v.id_vivienda) contador
		FROM vivienda v, ciudad c, categoria ca, tipo t, operacion o 
		WHERE v.id_ciudad=c.id_ciudad
		AND v.id_categoria=ca.id_categoria
		AND v.id_tipo=t.id_tipo
		AND v.id_operacion=o.id_operacion";

		 
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
	function count_viviendas_related($related){
		$sql = "SELECT COUNT(*) AS n_prod
				FROM vivienda v 
				WHERE v.id_ciudad = '$related'";

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


	function viviendas_related($type, $loaded, $items){
		$sql = "SELECT * 
				FROM vivienda v, ciudad c
				WHERE v.id_ciudad = c.id_ciudad 
				AND v.id_ciudad = '$type'
				LIMIT $loaded, $items";

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
	function update_visit($id){
		$sql = "UPDATE visitas 
				 SET num_visitas = num_visitas + 1
				 WHERE id_vivienda = '$id'";
	
		$conexion = connect::con();
		$res = mysqli_query($conexion, $sql);
		connect::close($conexion);
	
		if ($res) {
			
			return true;
		} else {
			
			return false;
		}
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
