<?php
	$path = $_SERVER['DOCUMENT_ROOT'] . '/crud/crud_MVC/';
    include($path . "model/connect.php");
    
	class DAOVivienda{
		function insert_vivienda($datos){
			// die('<script>console.log('.json_encode( $datos ) .');</script>');

			

			//$id = $datos ['id'];
			$m2 = $datos ['m2'];
			$tipo_vivenda = $datos ['tipo_vivenda'];
			// foreach ($datos['tipo_vivenda'] as $indice) {
        	//     $tipo_vivenda=$tipo_vivenda."$indice:";
        	// }
			$precio = $datos ['precio'];	
    		$fecha_publicacion = $datos ['fecha_publicacion'];	
			$ubicacion = $datos ['ubicacion'];	
			$num_habs = $datos ['num_habs'];	
			$referencia_catastral = $datos ['referencia_catastral'];	
			$Activo = $datos ['Activo'];
			 foreach ($datos['opcion'] as $indice) {
        	     $opcion=$opcion."$indice:";
        	}
			 foreach ($datos['categoria'] as $indice) {
        	     $categoria=$categoria."$indice:";
        	}




        	// $sql = "INSERT INTO usuario (user, pass, name, dni, sex, birthdate, age, country, language, comment, hobby)"
        	// 	. "VALUES ('$user', '$passwd', '$name', '$dni', '$sex', '$birthdate', '$age', '$country', '$language', '$comment', '$hobby')";
            
			$sql = "INSERT INTO vivenda(m2,tipo_vivenda,precio,fecha_publicacion,ubicacion,num_habs,referencia_catastral,Activo,opcion,categoria)" 
        			."VALUES('$m2','$tipo_vivenda','$precio','$fecha_publicacion','$ubicacion','$num_habs','$referencia_catastral','$Activo','$opcion','$categoria')";
			// die('<script>console.log('.json_encode( $sql ) .');</script>');
            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
			return $res;
		}
		
		function select_all_vivienda(){
			// $data = 'hola DAO select_all_vivienda';
            // die('<script>console.log('.json_encode( $data ) .');</script>');
			$sql = "SELECT * FROM vivenda ORDER BY id ASC";
			
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
			connect::close($conexion);
            return $res;
		}
		
		function select_id($id){
			// $data = 'hola DAO select_id';
            // die('<script>console.log('.json_encode( $data ) .');</script>');
			$sql = "SELECT * FROM vivenda WHERE id='$id'";		
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql)->fetch_object();
            connect::close($conexion);
            return $res;
		}
		
		function update_vivienda($datos){
			//die('<script>console.log('.json_encode( $datos ) .');</script>');
			
			$id = $datos ['id'];
			$m2 = $datos ['m2'];
			$tipo_vivenda = $datos ['tipo_vivenda'];
			$precio = $datos ['precio'];	
    		$fecha_publicacion = $datos ['fecha_publicacion'];	
			$ubicacion = $datos ['ubicacion'];	
			$num_habs = $datos ['num_habs'];	
			$referencia_catastral = $datos ['referencia_catastral'];	
			$Activo = $datos ['Activo'];
        	foreach ($datos['opcion'] as $indice) {
				$opcion=$opcion."$indice:";
		    }
        	foreach ($datos['categoria'] as $indice) {
				$categoria=$categoria."$indice:";
		    }

        	$sql = " UPDATE vivenda SET m2='$m2', tipo_vivenda='$tipo_vivenda', precio='$precio', fecha_publicacion='$fecha_publicacion'
			, ubicacion='$ubicacion', num_habs='$num_habs',"
        		. " referencia_catastral='$referencia_catastral', 
				Activo='$Activo', opcion='$opcion', categoria='$categoria' WHERE id='$id'";
            
            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
			return $res;
		}
		
		function delete_vivienda($id){
			$sql = "DELETE FROM vivenda WHERE id='$id'";
			
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            return $res;
		}

		function delete_all_vivienda(){
			$sql = "DELETE FROM vivenda";
			
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);

            return $res;
		}
		function dummies_vivienda(){
			$sql = "DELETE FROM vivenda;";

			$sql.= "INSERT INTO vivenda(m2,tipo_vivenda,precio,fecha_publicacion,ubicacion,num_habs,referencia_catastral,Activo,opcion,categoria)" 
			."VALUES('100','piso','200000','19/10/2023','Ontinyent','4','1653H','On','compra:alquiler:','lujo:terraza:');";
		
			$sql.= "INSERT INTO vivenda(m2,tipo_vivenda,precio,fecha_publicacion,ubicacion,num_habs,referencia_catastral,Activo,opcion,categoria)" 
			."VALUES('160','chalet','340000','02/06/2023','Benifaió','6','0867P','On','compra:alquiler:','cochera:');";
			
			$sql.= "INSERT INTO vivenda(m2,tipo_vivenda,precio,fecha_publicacion,ubicacion,num_habs,referencia_catastral,Activo,opcion,categoria)" 
			."VALUES('30','trastero','10000','14/07/2023','Benidorm','1','1664J','On','compra:','cochera:terraza:');";

			$sql.= "INSERT INTO vivenda(m2,tipo_vivenda,precio,fecha_publicacion,ubicacion,num_habs,referencia_catastral,Activo,opcion,categoria)" 
			."VALUES('90','piso','70000','12/05/2023','Muchamiel','3','5654L','On','compra:alquiler:','balcon:terraza:');";

			$sql.= "INSERT INTO vivenda(m2,tipo_vivenda,precio,fecha_publicacion,ubicacion,num_habs,referencia_catastral,Activo,opcion,categoria)" 
			."VALUES('250','finca','500000','29/10/2023','Alfarrasi','9','1223K','On','compra:','lujo:');";

			$conexion = connect::con();
            $res = mysqli_multi_query($conexion, $sql);
            connect::close($conexion);

            return $res;
		}
	}