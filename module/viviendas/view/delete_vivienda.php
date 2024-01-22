<style>
    #contenido_delete {
        width: 50%;
        margin: auto;
    }

    form {
        background-color: #f4f4f4;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h3 {
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    td {
        padding: 10px;
        text-align: center;
        border: 1px solid #ddd;
    }

 

   
</style>

<div id="contenido_delete">
    <form autocomplete="on" method="post" name="delete_vivienda" id="delete_vivienda">
        <table border='0'>
            <br></br>
            <br></br>
            <br></br>
            <tr>
                <td align="center"  colspan="2"><h3>¿Desea seguro borrar la vivienda <?php echo $_GET['id']; ?>?</h3></td>
                <input type="hidden" id="id" name="id" placeholder="id" value="<?php echo $vivienda['id'];?>"/>

            </tr>
            <tr>
                <td width=680 align="center"><input name="Submit" type="button" class="Button_green" onclick="operations_vivienda('delete')" value="Aceptar"/></td>
                <td align="center"><a class="Button_red" href="index.php?page=controller_vivienda&op=list" value="Cancelar">Cancelar</a></td>
            </tr>
        </table>
    </form>
</div>