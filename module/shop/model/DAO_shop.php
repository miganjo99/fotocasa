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
	function select_imgs_vivienda_array(){
		$sql = "SELECT i.img_vivienda
		FROM img_vivienda i, vivienda v
		WHERE v.id_img = i.id_vivienda";

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
