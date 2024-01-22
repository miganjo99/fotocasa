<style>
    #contenido {
        width: 50%;
        margin: auto;
    }

    form {
        background-color: #f4f4f4;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    td {
        padding: 10px;
        border: 1px solid #ddd;
    }

    input,
    select {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    input[type="number"],
    input[type="text"] {
        width: calc(100% - 18px);
        padding: 8px;
        box-sizing: border-box;
    }

    input[type="button"] {
        background-color: #4caf50;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="button"]:hover {
        background-color: #45a049;
    }

    a {
        text-decoration: none;
        color: #3498db;
    }

    .error {
        color: red;
    }
</style>

<div id="contenido">
    <form autocomplete="on" method="post" name="update_vivienda" id="update_vivienda">
    <br></br>
    <br></br>
    <br></br>
        <h2>Modificar vivienda</h2>
        <table border='0'>
        <br></br>
            <tr>
                <td>id </td>
                <td><input type="number" id="id" name="id" placeholder="id" value="<?php echo $vivienda['id'];?>"readonly/></td>
                
            </tr>
            
            <tr>
                <td>m2 </td>
                <td><input type="number" id="m2" name="m2" placeholder="m2" value="<?php echo $vivienda['m2'];?>"/></td>
                <td>
                    <font color="red">
                        <span id="error_m2" class="error"></span>
                    </font>
                </td>
            </tr>
        
            <tr>
                <td>Tipo vivienda </td>
                <!-- <td>
                    <select id="tipo_vivenda" name="tipo_vivenda" placeholder="tipo_vivenda" value="<?php echo $vivienda['tipo_vivenda'];?>">
                        <option value selected="<?php echo $vivienda['tipo_vivenda'];?>"></option>
                        <option value="chalet">chalet</option>
                        <option value="piso">piso</option>
                        <option value="trastero">trastero</option>
                        <option value="finca">finca</option>
                    </select>
                </td> -->
                <td><select id="tipo_vivenda" name="tipo_vivenda" placeholder="tipo_vivenda">
                    <?php
                        if($vivienda['tipo_vivenda']==="chalet"){
                    ?>
                        <option value="chalet" selected>chalet</option>
                        <option value="piso">piso</option>
                        <option value="trastero">trastero</option>
                        <option value="finca">finca</option>
                    <?php
                        }elseif($vivienda['tipo_vivenda']==="piso"){
                    ?>
                        <option value="chalet" >chalet</option>
                        <option value="piso"selected>piso</option>
                        <option value="trastero">trastero</option>
                        <option value="finca">finca</option>
                    <?php
                        }elseif($vivienda['tipo_vivenda']==="trastero"){
                    ?>
                        <option value="chalet" >chalet</option>
                        <option value="piso">piso</option>
                        <option value="trastero"selected>trastero</option>
                        <option value="finca">finca</option>
                    <?php
                        }else{
                    ?>
                        <option value="chalet" >chalet</option>
                        <option value="piso">piso</option>
                        <option value="trastero">trastero</option>
                        <option value="finca"selected>finca</option>
                    <?php
                        }
                    ?>
                    </select>
                </td>
                <td>
                    <font color="red">
                        <p id="error_tipo_vivenda" class="error">
                        </p>
                    </font>
                </td>
            </tr>

            <tr>
                <td>Precio: </td>
                <td><input type="number" id="precio" name="precio" placeholder="precio" value="<?php echo $vivienda['precio'];?>"/></td>
                <td><font color="red">
                    <p id="error_precio" class="error">                       
                    </p>
                </font></td>
            </tr>
            
            <tr>
                <td>Fecha de publicacion: </td>
                <td>
                    <input type="text" id="fecha_publicacion" name="fecha_publicacion" placeholder="fecha_publicacion" value="<?php echo $vivienda['fecha_publicacion'];?>"/>
                </td>
                
                <td>
                    <font color="red">
                        <p id="error_fecha_publicacion" class="error"></p>
                    </font>
                </td>
            </tr>

            <tr>
                <td>Ubicacion: </td>
                <td><input type="text" id="ubicacion" name="ubicacion" placeholder="ubicacion" value="<?php echo $vivienda['ubicacion'];?>"/></td>
                    <td>
                        <font color="red">
                            <p id="error_ubicacion" class="error">
                            </p>
                        </font>
                    </td>
            </tr>

            <tr>
                <td>Numero habitaciones: </td>
                    <td><input type="number" id= "num_habs" name="num_habs" placeholder="num_habs" value="<?php echo $vivienda['num_habs'];?>"/></td>
                <td>
                    <font color="red">
                        <p id="error_num_habs" class="error">
                        </p>
                    </font>
                </td>
            </tr>

            <tr>
                <td>Referencia catastral: </td>
                <td><input type="text" id="referencia_catastral" name="referencia_catastral" placeholder="referencia_catastral" value="<?php echo $vivienda['referencia_catastral'];?>"readonly/></td>
                <td>
                    <font color="red">
                        <p id="error_referencia_catastral" class="error"></p>
                    </font>
                </td>
            </tr>
            
           
            
            <tr>
                <td>Activo: </td>
                <!-- <td>
                    <input type="radio" id="Activo_on" name="Activo" placeholder="Activo" value="On"/>On
                    <input type="radio" id="Activo_off" name="Activo" placeholder="Activo" value="Off"/>Off
                </td> -->
                <td>
                    
                    <?php
                        if ($vivienda['Activo']==="On"){
                            ?>
                        <input type="radio" id="Activo_on" name="Activo" placeholder="Activo" value="On" checked/>On
                        <input type="radio" id="Activo_off" name="Activo" placeholder="Activo" value="Off"/>Off
                        <?php    
                        }else{
                            ?>
                        <input type="radio" id="Activo_on" name="Activo" placeholder="Activo" value="On"/>On
                        <input type="radio" id="Activo_off" name="Activo" placeholder="Activo" value="Off" checked/>Off
                        <?php   
                        }
                        ?>

                </td>    


                <td>
                    <font color="red">
                        <p id="error_activo" class="error">
                        </p>
                    </font>
                </td>
            </tr>
            
            <tr>
                <td>Opcion: </td>
                <?php
                    $opcion=explode(":", $vivienda['opcion']);
                ?>
                <td><select multiple size="2" id="opcion[]" name="opcion[]" placeholder="opcion">
                    <?php
                        $busca_array=in_array("compra", $opcion);
                        if($busca_array){
                    ?>
                        <option value="compra" selected>compra</option>
                    <?php
                        }else{
                    ?>
                        <option value="compra">compra</option>
                    <?php
                        }
                    ?>
                    <?php
                        $busca_array=in_array("alquiler", $opcion);
                        if($busca_array){
                    ?>
                        <option value="alquiler" selected>alquiler</option>
                    <?php
                        }else{
                    ?>
                        <option value="alquiler">alquiler</option>
                    <?php
                        }
                    ?>
                   
                    </select></td>
                <td><font color="red">
                    <span id="error_opcion" class="error">
                        
                    </span>
                </font></font></td>
            </tr>


            <tr>
                <td><input type="button" name="update" id="update"  onclick="validate_js('update')" value="Enviar"/></td>
                <td align="right"><a href="index.php?page=controller_vivienda&op=list">Volver</a></td>
            </tr>
        </table>
    </form>
</div>