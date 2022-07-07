<?php include("db.php"); ?>

<?php include('includes/header.php'); ?>

<main class="container p-4">
  <div class="row">
    <div class="col-md-4">
      <!-- MESSAGES -->

      <?php if (isset($_SESSION['message'])) { ?>
      <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php session_unset(); } ?>

      <!-- ADD TASK FORM -->
      <div class="card card-body">
        <form action="save_task.php" method="POST">
          <div class="form-group">
            <input type="text" name="Nombre" class="form-control" placeholder="Nombre" id="txtnombre" >
          </div>
          <div class="form-group">
            <input type="text" name="Apellido" class="form-control" placeholder="Apellido" id="txtapellido">
          </div>
          <div class="form-group">
            <input type="text" name="DNI" class="form-control" placeholder="DNI" id="txtdni" required>
          </div>
          <div class="form-group">
            <input type="text" name="Correo" class="form-control" placeholder="Correo" >
          </div>
          <div class="form-group">
            <textarea name="Razon" rows="1" class="form-control" placeholder="Razon"></textarea>
          </div>
          <input type="submit" name="save_task" class="btn btn-success btn-block" value="Registrar">
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>NOMBRE</th>
            <th>APELLIDO</th>
            <th>DNI</th>
            <th>ENTRADA</th>
            <th>SALIDA</th>
          </tr>
        </thead>
        <tbody>

          <?php

          $query = "SELECT * FROM visita WHERE Fecha_salida IS NULL";
          $result_tasks = mysqli_query($conexion, $query);    

          while($row = mysqli_fetch_assoc($result_tasks)) { ?>
          <tr>
            <td><?php echo $row['Nombre']; ?></td>
            <td><?php echo $row['Apellido']; ?></td>
            <td><?php echo $row['DNI']; ?></td>
            <td><?php echo $row['Fecha_entrada']; ?></td>
            <!-- <td><?php echo $row['Fecha_salida']; ?></td> -->
            <!--Los botones de editar y eliminar que funcionan -->
            <!-- <td>
              <a href="edit.php?ID=< ?php echo $row['ID']? >" class="btn btn-secondary">
                <i class="fas fa-marker"></i>
              </a>-->
            <td>
              <a href="exit.php?ID=<?php echo $row['ID']?>" class="btn btn-outline-success btn-block">
                <!-- <i class="far fa-trash-alt"></i> -->✔
            </a>
            </td> 
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<?php include('includes/footer.php'); ?>
