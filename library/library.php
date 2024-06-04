<?php

function listaCiudad($ciudad_id)
{

  $query = "SELECT `id`,`MUNICIPIO` FROM `maestra_ciudades` ORDER BY `MUNICIPIO` ASC";
  $result = mysqli_query($GLOBALS["connection"], $query);
  while ($row = mysqli_fetch_array($result)) { ?>

    <option value="<?php echo $row['id']; ?>" <?php if (isset($ciudad_id) && $ciudad_id == $row['id']) {
                                                echo "selected";
                                              } ?>><?php echo $row['MUNICIPIO']; ?></option>

<?php }
} ?>

<?php

function listaDepartamento($departamento_id)
{

  $query = "SELECT `id`,`departamento` FROM `maestra_departamentos` GROUP BY `departamento` ORDER BY `departamento` ASC";
  $result = mysqli_query($GLOBALS["connection"], $query);
  while ($row = mysqli_fetch_array($result)) { ?>

    <option value="<?php echo $row['id']; ?>" <?php if (isset($departamento_id) && $departamento_id == $row['id']) {
                                                echo "selected";
                                              } ?>><?php echo $row['departamento']; ?></option>

<?php }
} ?>

<?php

function listaMaterias()
{

  $query = "SELECT * FROM `maestra_materias` ORDER BY `codigo` ASC";
  $result = mysqli_query($GLOBALS["connection"], $query);
  while ($row = mysqli_fetch_array($result)) { ?>

    <option value="<?php echo $row['id']; ?>"><?php echo $row['codigo'] . " " . $row['materia']; ?></option>

<?php }
} ?>

<?php

function selectMaterias()
{ ?>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">Codigo</th>
        <th scope="col">Materia</th>
      </tr>
    </thead>
    <tbody>

      <?php
      $id = $GLOBALS['id'];
      $query = "SELECT * FROM `maestra_materias` INNER JOIN `materias` ON maestra_materias.id = materias.materia_id WHERE materias.usuario_id=$id";
      $result = mysqli_query($GLOBALS["connection"], $query);
      while ($row = mysqli_fetch_array($result)) { ?>

        <tr>
          <td><?php echo $row['codigo']; ?></td>
          <td><?php echo $row['materia']; ?></td>
        </tr>

      <?php } ?>

    </tbody>
  </table>

  <?php }

function selectDocumentos($tipo)
{

  $document = FALSE;

  if ($tipo == '1') {

    $query = "SELECT * FROM `documentos` WHERE tipo_id=$tipo AND usuario_id= $_SESSION[id]";
    $result = mysqli_query($GLOBALS["connection"], $query);
    while ($row = mysqli_fetch_array($result)) {

      $document = TRUE;

      $path = "storage/" . $_SESSION['usuario'] . "/documents/" . $row['file']; ?>

      <form action="crud/deleteDocuments.php" method="POST" onsubmit="return confirmation()">

        <div class="alert alert-success" class="align-self-center" role="alert">¡Cedula Cargada con Exito!

          <input name="tipo" type="hidden" value="<?php echo $tipo; ?>">
          <button type="button" class="btn btn-sm btn-primary" onclick="window.open('<?php echo $path; ?>', '_blank');"><i class="bi bi-file-earmark-check"></i></button>
          <button type="submit" class="btn btn-sm btn-danger" name="5489"><i class="bi bi-trash"></i></button>

        </div>

      </form>

    <?php }
  } elseif ($tipo == '2') {

    $query = "SELECT * FROM `documentos` WHERE tipo_id=$tipo AND usuario_id= $_SESSION[id]";
    $result = mysqli_query($GLOBALS["connection"], $query);
    while ($row = mysqli_fetch_array($result)) {

      $document = TRUE;

      $path = "storage/" . $_SESSION['usuario'] . "/studies/" . $row['file']; ?>

      <form action="crud/deleteDocuments.php" method="POST" onsubmit="return confirmation()">

        <div class="alert alert-success" class="align-self-center" role="alert">¡Estudios Cargados con Exito!

          <input name="tipo" type="hidden" value="<?php echo $tipo; ?>">
          <button type="button" class="btn btn-sm btn-primary" onclick="window.open('<?php echo $path; ?>', '_blank');"><i class="bi bi-file-earmark-check"></i></button>
          <button type="submit" class="btn btn-sm btn-danger" name="5489"><i class="bi bi-trash"></i></button>

        </div>

      </form>

    <?php }
  } elseif ($tipo == '3') {

    $query = "SELECT * FROM `documentos` WHERE tipo_id=$tipo AND usuario_id= $_SESSION[id]";
    $result = mysqli_query($GLOBALS["connection"], $query);
    while ($row = mysqli_fetch_array($result)) {

      $document = TRUE;

      $path = "storage/" . $_SESSION['usuario'] . "/experience/" . $row['file']; ?>

      <form action="crud/deleteDocuments.php" method="POST" onsubmit="return confirmation()">

        <div class="alert alert-success" class="align-self-center" role="alert">Experiencia Cargados con Exito!

          <input name="tipo" type="hidden" value="<?php echo $tipo; ?>">
          <button type="button" class="btn btn-sm btn-primary" onclick="window.open('<?php echo $path; ?>', '_blank');"><i class="bi bi-file-earmark-check"></i></button>
          <button type="submit" class="btn btn-sm btn-danger" name="5489"><i class="bi bi-trash"></i></button>

        </div>

      </form>

<?php }
  }

  return $document;
} ?>