<div id="contenido">
    <h1>Informacion de la Vivienda</h1>
    <p>
    <table border='2'>
        <tr>
            <td>id: </td>
            <td>
                <?php
                    echo $vivienda['id'];
                ?>
            </td>
        </tr>
    
        <tr>
            <td>m2: </td>
            <td>
                <?php
                    echo $vivienda['m2'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>tipo vivienda: </td>
            <td>
                <?php
                    echo $vivienda['tipo_vivenda'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>precio: </td>
            <td>
                <?php
                    echo $vivienda['precio'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>fecha publicacion: </td>
            <td>
                <?php
                    echo $vivienda['fecha_publicacion'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>ubicacion: </td>
            <td>
                <?php
                    echo $vivienda['ubicacion'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Numero habitaciones: </td>
            <td>
                <?php
                    echo $vivienda['num_habs'];
                ?>
            </td>
            
        </tr>
        
        <tr>
            <td>Referencia catastral: </td>
            <td>
                <?php
                    echo $vivienda['referencia_catastral'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Activo: </td>
            <td>
                <?php
                    echo $vivienda['Activo'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Opcion: </td>
            <td>
                <?php
                    echo $vivienda['opcion'];
                ?>
            </td>
        </tr>
        <tr>
            <td>Categoria: </td>
            <td>
                <?php
                    echo $vivienda['categoria'];
                ?>
            </td>
        </tr>
        
    </table>
    </p>
    <p><a href="index.php?page=controller_vivienda&op=list">Volver</a></p>
</div>