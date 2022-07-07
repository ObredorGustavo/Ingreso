<?php

include('db.php');

if (isset($_POST['save_task'])) {
    $Nombre = $_POST['Nombre'];
    $Apellido = $_POST['Apellido'];
    $DNI = $_POST['DNI'];
    $Correo = $_POST['Correo'];
    $Razon = $_POST['Razon'];
    $Lugar = 'Municipalidad de Godoy Cruz';
    $Fecha_entrada = date('d-m-y h:i:s a', time());
    $Fecha_Salida = date('d-m-Y h:i:s a', time());

    //Existe un registro con ese DNI en la tabla?//////////////////////////////////////////////////////////////
    $consultaregi="SELECT * FROM registro WHERE DNI='$DNI'";

    $resultado=mysqli_query($conexion, $consultaregi);

        if (mysqli_num_rows($resultado) == null)//No existe un registro con ese DNI
        {
            $insertre ="INSERT INTO registro(DNI, Nombre, Apellido, Correo, Lugar) VALUES ( '$DNI', '$Nombre', '$Apellido', '$Correo', '$Lugar' )";
            $insert ="INSERT INTO visita(DNI, Nombre, Apellido, Razon, Fecha_entrada, correo) VALUES ( '$DNI', '$Nombre', '$Apellido', '$Razon', '$Fecha_entrada','$Correo' )";
            $i= 0;
//////////////////////////////////////////////////////////////////////
            switch ($i) {
                case 0:
                    mysqli_query($conexion, $insertre);
                    
                case 1:
                    mysqli_query($conexion, $insert);
                    mysqli_close($conexion);
            }

        } else {//Si existe un registro con ese DNI en la tabla
            //Tiene el campo de salida el ultimo registro que existe con esos datos?//////////////////////////
            $consultaid = "SELECT Fecha_salida FROM visita WHERE DNI = '$DNI' AND Fecha_salida IS NULL /*AND ID = (SELECT MAX(ID) FROM visita)*/";
            $resultado=mysqli_query($conexion, $consultaid);
            $coincide= $resultado->num_rows;

            if ( $coincide == 1){//echo "llenar la salida"; es 1
                $consulta="UPDATE visita SET Fecha_salida='$Fecha_Salida' WHERE DNI='$DNI' AND Fecha_salida IS NULL /*AND ID = (SELECT MAX(ID) FROM visita)*/";
                mysqli_query($conexion, $consulta);
                mysqli_close($conexion);

            }else{//echo "crear nuevo"; sino es 0
                $nuevo ="INSERT INTO visita(DNI, Nombre, Apellido, Razon, Fecha_entrada, correo) VALUES ( '$DNI', '$Nombre', '$Apellido', '$Razon', '$Fecha_entrada','$Correo' )";
                mysqli_query($conexion, $nuevo);
                mysqli_close($conexion);    
           
		    }     
        }

        $_SESSION['message'] = 'REGISTRO CORRECTO';
        $_SESSION['message_type'] = 'success';
        header('Location: index.php');

}

?>
