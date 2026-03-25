<?php
include("conexion.php");
$con = conexion();

$buscar = isset($_GET["buscar"]) ? $_GET["buscar"] : "";

if ($buscar != "") {
    $sql = "SELECT * FROM persona WHERE documento LIKE $1 OR nombre LIKE $1 OR apellido LIKE $1 OR direccion LIKE $1 OR celular LIKE $1 ORDER BY id ASC";
    $resultado = pg_query_params($con, $sql, ["%" . $buscar . "%"]);
} else {
    $sql = "SELECT * FROM persona ORDER BY id ASC";
    $resultado = pg_query($con, $sql);
}
?>
<!doctype html>
<html lang="es">
  <head>
    <title>Listar Personas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>

  <body>

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
      <h5 class="my-0 mr-md-auto font-weight-normal"><img src="index2.png" style="width: 30px; position: absolute;"> <span style="position: relative; left: 35px;">Index</span></h5>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="index.php">Registrar</a>
        <a class="p-2 text-dark font-weight-bold" href="listar.php">Listar</a>
      </nav>
    </div>

    <div class="container px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Listado de Personas</h1>
      <p class="lead">PostgreSQL + PHP</p>
    </div>

    <div class="container">
      <div class="card mb-4">
        <div class="card-body">
          <form method="get" action="listar.php" class="form-inline justify-content-center">
            <input type="text" name="buscar" class="form-control mr-2" placeholder="Buscar por nombre, documento..." value="<?php echo htmlspecialchars($buscar); ?>">
            <button type="submit" class="btn btn-primary mr-2">Buscar</button>
            <?php if ($buscar != ""): ?>
              <a href="listar.php" class="btn btn-secondary">Limpiar</a>
            <?php endif; ?>
          </form>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead class="thead-dark">
                <tr>
                  <th>ID</th>
                  <th>Documento</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Direccion</th>
                  <th>Celular</th>
                </tr>
              </thead>
              <tbody>
                <?php if (pg_num_rows($resultado) > 0): ?>
                  <?php while ($fila = pg_fetch_assoc($resultado)): ?>
                    <tr>
                      <td><?php echo htmlspecialchars($fila["id"]); ?></td>
                      <td><?php echo htmlspecialchars($fila["documento"]); ?></td>
                      <td><?php echo htmlspecialchars($fila["nombre"]); ?></td>
                      <td><?php echo htmlspecialchars($fila["apellido"]); ?></td>
                      <td><?php echo htmlspecialchars($fila["direccion"]); ?></td>
                      <td><?php echo htmlspecialchars($fila["celular"]); ?></td>
                    </tr>
                  <?php endwhile; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="6" class="text-center text-muted">No se encontraron registros</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
          <p class="text-muted mb-0">Total de registros: <?php echo pg_num_rows($resultado); ?></p>
        </div>
      </div>

      <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
          <div class="col-12 col-md">
            <img class="mb-2" src="https://www.svgrepo.com/show/508391/uncle.svg" alt="" width="24" height="24">
            <small class="d-block mb-3 text-muted">&copy; 2023-1</small>
          </div>
        </div>
      </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
