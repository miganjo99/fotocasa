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
</style>

<div id="contenido">
    <form autocomplete="on" method="post" name="alta_vivienda" id="alta_vivienda" > 
        
        <br></br>
        <br></br>
        <br></br>
        <h2>Vivienda nueva</h2>
        <!--  -->
        <table border='0'>
            <tr>
                <td>m2 </td>
                <td><input type="number" id="m2" name="m2" placeholder="m2" value=""/></td>
                <td>
                    <font color="red">
                        <span id="error_m2" class="error"></span>
                    </font>
                </td>
            </tr>

            <tr>
                <td>Tipo vivienda </td>
                <td>
                    <select id="tipo_vivenda" name="tipo_vivenda" placeholder="tipo_vivenda">
                        <option selected value = "ninguno">ninguno</option>
                        <option value="chalet">chalet</option>
                        <option value="piso">piso</option>
                        <option value="trastero">trastero</option>
                        <option value="finca">finca</option>
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
                <td><input type="number" id="precio" name="precio" placeholder="precio" value=""/></td>
                <td><font color="red">
                    <p id="error_precio" class="error">                       
                    </p>
                </font></td>
            </tr>
            
            <tr>
                <td>Fecha de publicacion: </td>
                <td>
                    <input type="text" id="fecha_publicacion" name="fecha_publicacion" placeholder="fecha_publicacion" value=""/>
                </td>
                
                <td>
                    <font color="red">
                        <p id="error_fecha_publicacion" class="error"></p>
                    </font>
                </td>
            </tr>

            <tr>
                <td>Ubicacion: </td>
                <td><input type="text" id="ubicacion" name="ubicacion" placeholder="ubicacion" value=""/></td>
                    <td>
                        <font color="red">
                            <p id="error_ubicacion" class="error">
                            </p>
                        </font>
                    </td>
            </tr>

            <tr>
                <td>Numero habitaciones: </td>
                    <td><input type="number" id= "num_habs" name="num_habs" placeholder="num_habs" value=""/></td>
                <td>
                    <font color="red">
                        <p id="error_num_habs" class="error">
                        </p>
                    </font>
                </td>
            </tr>

            <tr>
                <td>Referencia catastral: </td>
                <td><input type="text" id="referencia_catastral" name="referencia_catastral" placeholder="referencia_catastral" value=""/></td>
                <td>
                    <font color="red">
                        <p id="error_referencia_catastral" class="error"></p>
                    </font>
                </td>
            </tr>
            
           
            
            <tr>
                <td>Activo: </td>
                <td>
                    <input type="radio" id="Activo_on" name="Activo" placeholder="Activo" value="On"/>On
                    <input type="radio" id="Activo_off" name="Activo" placeholder="Activo" value="Off"/>Off
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
                <td>
                    <!-- <select multiple size="2" id="opcion[]" name="opcion[]" placeholder="opcion">                  -->
                        <!-- <option value="compra">compra</option>
                        <option value="alquiler">alquiler</option> -->
                    <input type="checkbox" id= "opcion[]" name="opcion[]" placeholder= "opcion" value="comprar"/>comprar
                    <input type="checkbox" id= "opcion[]" name="opcion[]" placeholder= "opcion" value="vender"/>vender
                    <!-- </select> -->
                </td>
                <td>
                    <font color="red">
                        <p id="error_opcion" class="error">                      
                        </p>
                    </font>
                </td>
            </tr>                      
            
            <tr>
                <td><input name="Submit" type="button" onclick="validate_js('create')" value="Enviar"/></td>
                <td align="right"><a href="index.php?page=controller_vivienda&op=list">Volver</a></td>
            </tr>
        </table>
    </form>
</div>