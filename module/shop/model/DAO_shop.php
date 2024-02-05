<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/crud/crud_MVC/';
include($path . "model/connect.php");

// $datos="select all viviendas die";
// die('<script>console.log('.json_encode( $datos ) .');</script>');


class DAOShop{

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

	// function select_one_car($id){
	// 	$sql = "SELECT *
	// 	FROM car c, model m, type_motor t, category ca
	// 	WHERE c.id_car = '$id'
	// 	AND  c.model = m.id_model 
	// 	AND c.category = ca.id_cat
	// 	AND c.motor = t.cod_tmotor";

	// 	$conexion = connect::con();
	// 	$res = mysqli_query($conexion, $sql)->fetch_object();
	// 	connect::close($conexion);

	// 	return $res;
	// }

	// function select_imgs_car($id){
	// 	$sql = "SELECT i.id_car, i.img_cars
	// 		    FROM img_cars i
	// 		    WHERE i.id_car = '$id'";

	// 	$conexion = connect::con();
	// 	$res = mysqli_query($conexion, $sql);
	// 	connect::close($conexion);

	// 	$imgArray = array();
	// 	if (mysqli_num_rows($res) > 0) {
	// 		foreach ($res as $row) {
	// 			array_push($imgArray, $row);
	// 		}
	// 	}
	// 	return $imgArray;
	// }
}
