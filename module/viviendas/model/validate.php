<?php
    

    function validate_referencia_catastral($referencia_catastral){
        $sql = "SELECT * FROM vivenda WHERE referencia_catastral='$referencia_catastral'";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        $res = $res->num_rows;
        connect::close($conexion);
        return $res;
    }
    
    function validate() {
        // $data = 'hola validate php';
        // die('<script>console.log('.json_encode( $data ) .');</script>');

        $check = true;

        //$id = $_POST['id'];
        $referencia_catastral = $_POST['referencia_catastral'];
        $referencia_catastral_validated = validate_referencia_catastral($referencia_catastral);
        
        //die('<script>console.log('.json_encode( $referencia_catastral ) .');</script>');
        //$referencia_catastral > 0
        // if($referencia_catastral !== null){
        //print("Validate php");
        if(  $referencia_catastral_validated > 0  ){

            echo '<script language="javascript">setTimeout(() => {
                toastr.error("La referencia catastral no puede estar repetida");
                }, 1000);</script>';
            $check = false;
        }

       

        return $check;
    }

