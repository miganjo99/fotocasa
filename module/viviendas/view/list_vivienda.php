<style>
    #contenido {
        width: 80%;
        margin: auto;
    }

    .container {
        margin-top: 20px;
    }

    h2 {
        color: #333;
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #3498db;
        color: white;
    }

   

    .Button_blue:hover, .Button_green:hover, .Button_red:hover {
        background-color: #2980b9;
    }

    .vivienda {
        cursor: pointer;
    }

   
</style>

<div id="contenido">
    <div class="container">
    	<div class="row">
                <br></br>
                <br></br>
                <br></br>
    			<h2>LISTA DE VIVIENDAS</h2> 
    	</div>
        
        
        <div class="row">
            <br></br>
            <th><p><a href="index.php?page=controller_vivienda&op=create"><img src="view/img/anadir.png"></a></p></th>
            <br></br>
            <th><p><a href="index.php?page=controller_vivienda&op=delete_all"><img src="view/img/basura.png"></a></p></th>
            <br></br>
            <th><p><a href="index.php?page=controller_vivienda&op=dummies"><img src="view/img/alojamiento.png"></a></p></th>
            <br></br>
    		<table>
                <tr>
                    <td width=125><b>id</b></td>
                    <td width=125><b>m2</b></td>
                    <td width=125><b>tipo</b></td>
                    <td width=125><b>precio</b></td>
                    <!-- <td width=125><b>fecha_publicacion</b></td>
                    <td width=125><b>ubicacion</b></td>
                    <td width=125><b>num_habs</b></td>
                    <td width=125><b>referencia_catastral</b></td> -->
                    <td width=125><b>estado</b></td>
                    <td width=125><b>opcion</b></td>
                    <td width=125><b>categoria</b></td>
                    <td width=350><b>accion</b></td>
                </tr>
                <?php
                    if ($rdo->num_rows === 0){
                        echo '<tr>';
                        echo '<td align="center"  colspan="3">NO HAY NINGUNA VIVIENDA</td>';
                        echo '</tr>';
                    }else{
                        foreach ($rdo as $row) {
                            
                            echo '<tr>';
                    	   	echo '<td width=125>'. $row['id'] . '</td>';
                    	   	echo '<td width=125>'. $row['m2'] . '</td>';
                    	   	echo '<td width=125>'. $row['tipo_vivenda'] . '</td>';
                    	   	echo '<td width=125>'. $row['precio'] . '</td>';
                    	   	// echo '<td width=125>'. $row['fecha_publicacion'] . '</td>';
                    	   	// echo '<td width=125>'. $row['ubicacion'] . '</td>';
                    	   	// echo '<td width=125>'. $row['num_habs'] . '</td>';
                    	   	// echo '<td width=125>'. $row['referencia_catastral'] . '</td>';
                    	   	echo '<td width=125>'. $row['Activo'] . '</td>';
                    	   	echo '<td width=125>'. $row['opcion'] . '</td>';
                    	   	echo '<td width=125>'. $row['categoria'] . '</td>';

                    	   	echo '<td width=350>';
                            
                            
                        
                            // echo '<br></br>';
                    	   	//echo '<a class="Button_blue" href="index.php?page=controller_vivienda&op=read&id='.$row['id'].'">Read</a>';
                           print ("<div class='vivienda' id='".$row['id']."'><a class='Button_blue' data-tr='Read'>Read modal</a></div>");  //READ
                            echo '&nbsp;';
                            
                            echo '<br></br>';
                    	   	echo '<a class="Button_green" href="index.php?page=controller_vivienda&op=update&id='.$row['id'].'">Update</a>';
                    	   	echo '&nbsp;';
                            echo '<br></br>';
                    	   	echo '<a class="Button_red" href="index.php?page=controller_vivienda&op=delete&id='.$row['id'].'">Delete</a>';
                            
                            echo '<br></br>';
                            echo '</td>';
                    	   	echo '</tr>';


                        }
                    }
                ?>
            </table>
    	</div>
    </div>
</div>

<!-- modal window -->
<section id="vivienda_modal">
</section>