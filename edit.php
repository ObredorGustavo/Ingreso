<?php
//Este archivo esta comentado en el index ya que no se debe poder editar, pero funciona
include("db.php");
$Nombre = '';
$Razon= '';

if  (isset($_GET['ID'])) {
  $ID = $_GET['ID'];
  $query = "SELECT * FROM visita WHERE ID=$ID";
  $result = mysqli_query($conexion, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $Nombre = $row['Nombre'];
    $Apellido = $row['Apellido'];
    $Entrada = $row['Fecha_entrada'];
    $Razon = $row['Razon'];
  }
}

if (isset($_POST['update'])) {
  $ID = $_GET['ID'];
  $Nombre= $_POST['Nombre'];
  $Apellido= $_POST['Apellido'];
  $Razon = $_POST['Razon'];

  $query = "UPDATE visita set Nombre = '$Nombre', Apellido = '$Apellido', Razon = '$Razon' WHERE ID=$ID";

  mysqli_query($conexion, $query);
  $_SESSION['message'] = 'Registro Actualizado';
  $_SESSION['message_type'] = 'warning';
  header('Location: index.php');
}

?>
<?php include('includes/header.php'); ?>
<div class="container p-7">
  <div class="row">
    <div class="col-md-5 mx-auto">
      <div class="card card-body">
      <form action="edit.php?ID=<?php echo $_GET['ID']; ?>" method="POST">
        <div class="form-group">
          <input name="Nombre" type="text" class="form-control" value="<?php echo $Nombre; ?>" placeholder="Actualizar Nombre">
        </div>
        <div class="form-group">
          <input name="Apellido" type="text" class="form-control" value="<?php echo $Apellido; ?>" placeholder="Actualizar Apellido">
        </div>
        <div class="form-group">
        <textarea name="Razon" class="form-control" cols="30" rows="3"><?php echo $Razon;?></textarea>
        </div>
        <button class="btn-success btn-block" name="update">
          Actualizar
</button>
      </form>
      </div>
    </div>
  </div>
</div>
<?php include('includes/footer.php'); ?>
