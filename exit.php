<?php
include("db.php");

if(isset($_GET['ID'])) {
  $ID = $_GET['ID'];
  $Fecha_Salida = date('d-m-Y h:i:s a', time());
  $query = "UPDATE visita SET Fecha_salida='$Fecha_Salida' WHERE ID = $ID";
  $result = mysqli_query($conexion, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'REGISTRO DE SALIDA EXITOSO';
  $_SESSION['message_type'] = 'success';
  header('Location: index.php');

}

?>
