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

    h3 {
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th {
        padding: 15px;
        background-color: #3498db;
        color: white;
        text-align: center;
        border: 1px solid #ddd;
    }

    td {
        padding: 10px;
        text-align: center;
        border: 1px solid #ddd;
    }


</style>

<div id="contenido">
    <form autocomplete="on" method="post" name="dummies_vivienda" id="dummies_vivienda">
        <table border='0'>
            <br></br>
            <br></br>
            <br></br>
            <tr>
                <th width=1200><h3>¿Quieres cargar los datos de las viviendas?</h3></td>
                <input type="hidden" id="id" name="id" placeholder="id" value="prova"/>
            </tr>
        </table>
        <table border='0'>
            <tr>
                <td width=680 align="center"><input name="Submit" type="button" class="Button_green" onclick="operations_vivienda('dummies')" value="Aceptar"/></td>
                <td width=680 align="center"><a class="Button_red" href="index.php?page=controller_vivienda&op=list">Cancelar</a></td>
            </tr>
        </table>
    </form>
</div>