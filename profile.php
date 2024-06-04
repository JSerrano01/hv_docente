<!DOCTYPE html>
<?php

$allowedRoles = ['administrador', 'coordinador', 'docente'];
$studies = FALSE;
$experience = FALSE;

include('access.php');
include('database.php');
include('library/library.php');

?>

<html lang="en">

<head><?php include('head.php'); ?></head>

<body>

  <?php include('navbar.php'); ?>

  <!------------------------------------------- Carga de Infomracion del Perfil del Usuario ---------------------------------------------------------------------------->
  <div class="container p-2">
    <div class="row justify-content-center">
      <div class="col">
        <div class="card">
          <div class="card-header">Perfil</div>
          <div class="card-body">

            <form action="crud/insertProfile.php" method="POST" onsubmit="return mensajeActualizacion()">

              <?php
              //------------------------------ Query para traer la informacion completa del Usuario
              $query = "SELECT * FROM perfiles JOIN `usuarios` ON perfiles.usuario_id = usuarios.id WHERE usuario_id = $id";
              $result = mysqli_query($connection, $query);
              $row = mysqli_fetch_array($result);

              ?>

              <div class="row">

                <div class="form-group col-md-3">
                  <label for="nombre">Primer Nombre</label>
                  <input id="primer_nombre" name="primer_nombre" type="text" class="form-control" value="<?php if (isset($row['primer_nombre'])) {
                                                                                                            echo $row['primer_nombre'];
                                                                                                          } ?>" required>
                </div>

                <div class="form-group col-md-3">
                  <label for="nombre">Segundo Nombre</label>
                  <input id="segundo_nombre" name="segundo_nombre" type="text" class="form-control" value="<?php if (isset($row['segundo_nombre'])) {
                                                                                                              echo $row['segundo_nombre'];
                                                                                                            } ?>">
                </div>

                <div class="form-group col-md-3">
                  <label for="apellido">Primer Apellido</label>
                  <input id="primer_apellido" name="primer_apellido" type="text" class="form-control" value="<?php if (isset($row['primer_apellido'])) {
                                                                                                                echo $row['primer_apellido'];
                                                                                                              } ?>" required>
                </div>

                <div class="form-group col-md-3">
                  <label for="segundo_apellido">Segundo Apellido</label>
                  <input id="segundo_apellido" name="segundo_apellido" type="text" class="form-control" value="<?php if (isset($row['segundo_apellido'])) {
                                                                                                                  echo $row['segundo_apellido'];
                                                                                                                } ?>">
                </div>

              </div>

              <div class="row">

                <div class="form-group col-md-6">
                  <label for="nacimiento">Fecha de nacimiento</label>
                  <input id="nacimiento" name="nacimiento" type="date" class="form-control" value="<?php if (isset($row['nacimiento'])) {
                                                                                                      echo $row['nacimiento'];
                                                                                                    } ?>" required>
                </div>

              </div>

              <div class="row">

                <div class="form-group col-md-6">
                  <label for="documento">Tipo de documento</label>
                  <select id="documento" name="documento" class="form-control">

                    <option value="1" <?php if (isset($row['documento_id']) && $row['documento_id'] == 1) {
                                        echo "selected";
                                      } ?>>Cédula de Ciudadanía</option>
                    <option value="2" <?php if (isset($row['documento_id']) && $row['documento_id'] == 2) {
                                        echo "selected";
                                      } ?>>Cédula de Extranjería</option>

                  </select>
                </div>

                <div class="form-group col-md-6">
                  <label for="numero_documento">Número de documento</label>
                  <input id="numero_documento" name="numero_documento" type="tel" class="form-control" pattern="[0-9]+" value="<?php if (isset($documento)) {
                                                                                                                                  echo $documento;
                                                                                                                                } ?>" disabled>
                </div>

              </div>

              <div class="row">

                <!--<div class="form-group col-md-6">
                            <label for="fecha_documento">Fecha de expedición</label>
                            <input id="fecha_documento" name="fecha_documento" type="date" class="form-control" value="<?php if (isset($row['fecha_documento'])) {
                                                                                                                          echo $row['fecha_documento'];
                                                                                                                        } ?>" required>
                        </div>-->

                <div class="form-group col-md-6">
                  <label for="correo">Correo Electronico</label>
                  <input type="email" class="form-control" name="correo" placeholder="ejemplo@colmayor.edu.co" value="<?php if (isset($_SESSION['email'])) {
                                                                                                                        echo $_SESSION['email'];
                                                                                                                      } ?>" disabled>
                </div>

              </div>

              <div class="row">

                <div class="form-group col-md-6">
                  <label for="celular">Telefono Celular</label>
                  <input id="celular" name="celular" type="tel" class="form-control" maxlength="10" pattern="[0-9]+" value="<?php if (isset($row['celular'])) {
                                                                                                                              echo $row['celular'];
                                                                                                                            } ?>" required>
                </div>

                <div class="form-group col-md-6">
                  <label for="fijo">Telefono Fijo</label>
                  <input id="fijo" name="fijo" type="tel" class="form-control" maxlength="7" pattern="[0-9]+" value="<?php if (isset($row['fijo'])) {
                                                                                                                        echo $row['fijo'];
                                                                                                                      } ?>">
                </div>

              </div>

              <!--<div class="row">

                        <div class="form-group col-md-6">
                            <label for="correo">Correo Personal</label>
                            <input id="correo" name="correo" type="email" class="form-control" placeholder="colmayor@colmayor.edu.co" value="{{$teacher->email}}">
                        </div>

                      </div> -->

              <div class="row">
                <div class="form-group">
                  <label for="direccion">Dirección de Residencia</label>
                  <input id="direccion" name="direccion" type="text" class="form-control" placeholder="Carrera 78 # 65 - 46 Bloque Patrimonial" value="<?php if (isset($row['direccion'])) {
                                                                                                                                                          echo $row['direccion'];
                                                                                                                                                        } ?>" required>
                </div>
              </div>

              <div class="row">

                <div class="form-group col-md-6">
                  <label for="departamento">Departamento de Residencia</label>
                  <select id="departamento" name="departamento" class="form-select">

                    <?php listaDepartamento($row['departamento_id']) ?>

                  </select>
                </div>

                <div class="form-group col-md-6">
                  <label for="ciudad">Cuidad de Residencia</label>
                  <select id="ciudad" name="ciudad" class="form-select">

                    <?php listaCiudad($row['ciudad_id']) ?>

                  </select>
                </div>

              </div>

              <!--<div class="row">

                        <div class="form-group col-md-6">
                            <label for="cantidad_convive">¿Con cuántas personas comparte la vivienda actualmente?</label>
                            <input id="cantidad_convive" name="cantidad_convive" type="number" class="form-control" value="<?php if (isset($row['cantidad_convive'])) {
                                                                                                                              echo $row['cantidad_convive'];
                                                                                                                            } ?>" required>
                        </div>

                        <div class="form-group col-md-6">
                          <label for="convive">¿Con quién convive actualmente?</label>
                          <select id="convive" name ="convive" class="form-control">
                            <option value="1" <?php if (isset($row['pariente_id']) && $row['pariente_id'] == 1) {
                                                echo "selected";
                                              } ?> >Cónyuge o compañero</option>
                            <option value="2" <?php if (isset($row['pariente_id']) && $row['pariente_id'] == 2) {
                                                echo "selected";
                                              } ?> >Papá</option>
                            <option value="3" <?php if (isset($row['pariente_id']) && $row['pariente_id'] == 3) {
                                                echo "selected";
                                              } ?> >Mamá</option>
                            <option value="4" <?php if (isset($row['pariente_id']) && $row['pariente_id'] == 4) {
                                                echo "selected";
                                              } ?> >Hijos</option>
                            <option value="5" <?php if (isset($row['pariente_id']) && $row['pariente_id'] == 5) {
                                                echo "selected";
                                              } ?> >Otros</option>
                          </select>
                        </div>
                      </div>-->

              <div class="p-2">
                <button type="submit" class="btn btn-success">Actualizar</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--------------------------------- Subida de documentos personales ------------------->
  <?php if (isset($row['primer_nombre'])) { ?>
    <div class="container p-2">
      <div class="row justify-content-center">
        <div class="col">
          <div class="card">
            <div class="card-header">Documentos Personales</div>
            <div class="card-body">

              <div class="row">

                <div class="col-md-6">

                  <form action="crud/insertDocuments.php" method="POST" enctype="multipart/form-data" onsubmit="return mensajeActualizacion()">

                    <div class="row">

                      <div class="form-group col-md-8">

                        <input name="tipo" type="hidden" value="1">
                        <label for="file" class="form-label"> Soporte Cedula</label>
                        <input class="form-control" type="file" name="file" id="file" accept=".pdf" required>

                      </div>

                      <div class="form-group col-md-4 align-self-end">

                        <button type="submit" class="btn btn-success">Aceptar</button>

                      </div>



                    </div>
                  </form>
                </div>

                <div class="col">

                  <?php $document = selectDocumentos(1); ?>

                </div>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

  <?php }; ?>

  <!------------------------------ Contenedor de Estudios Realizados ------------------------------->

  <?php if (isset($row['primer_nombre'])) { ?>

    <div class="container p-2" id="tarjetaEstudios">
      <div class="row justify-content-center">
        <div class="col">
          <div class="card">
            <div class="card-header">Estudios Realizados</div>
            <div class="card-body">

              <form action="crud/insertStudies.php" method="POST" enctype="multipart/form-data" onsubmit="return mensajeActualizacion()">

                <div class="row">
                  <div class="form-group col-md-2">
                    <label for="tipo">Tipo</label>
                    <select id="tipo" name="tipo" class="form-select" required>
                      <option value="1">Pregrado</option>
                      <option value="5">Especializacion</option>
                      <option value="2">Maestria</option>
                      <option value="3">Doctorado</option>
                      <option value="4">Otros relacionados con Docencia</option>
                    </select>
                  </div>

                  <div class="form-group col-md-2">
                    <label for="fecha_graduacion">Fecha de Graduacion</label>
                    <input id="fecha_graduacion" name="fecha_graduacion" type="date" class="form-control" required>
                  </div>

                  <div class="form-group col-md-7">
                    <label for="titulo">Titulo</label>
                    <input id="titulo" name="titulo" type="text" class="form-control" required>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-8">
                    <input name="tipo_documento" type="hidden" value="2" required>
                    <br>
                    <label for="file" class="form-label">Soporte Estudio Realizado</label>
                    <input class="form-control" type="file" name="file" id="file" accept=".pdf" required>
                  </div>
                </div>

                <br>

                <div class="form-group col-md-1 align-self-end">
                  <button type="submit" class="btn btn-success">Aceptar</button>
                </div>

              </form>

              <div class="table-responsive pt-4">
                <table class="table">
                  <thead class="table-dark">
                    <tr>
                      <th scope="col" width="10%">Tipo</th>
                      <th scope="col" width="10%">Graduacion</th>
                      <th scope="col">Titulo</th>
                      <th scope="col" width="10%" style="text-align: center">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                    $query = connection()->query("SELECT estudios.*, maestra_titulo.*, usuarios.numero_documento
                    FROM `estudios`
                    INNER JOIN `maestra_titulo` ON estudios.tipo = maestra_titulo.id
                    INNER JOIN `usuarios` ON estudios.usuario_id = usuarios.id
                    WHERE estudios.usuario_id = $id");


                    while ($row = mysqli_fetch_array($query)) {

                      $numeroDocumento = $row['numero_documento'];
                      $path = "storage/" . $numeroDocumento . "/studies/" . $row['file'];

                      $studies = TRUE; ?>

                      <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['fecha_graduacion']; ?></td>
                        <td><?php echo $row['titulo']; ?></td>
                        <td style="text-align: center" colspan="2">
                          <div style="display: flex; justify-content: center; align-items: center;">
                            <button type="button" class="btn btn-sm btn-info" onclick="window.open('<?php echo $path; ?>', '_blank');" style="margin-right: 5px;">
                              <i class="bi bi-file-earmark-check"></i>
                            </button>
                            <form action="crud/deleteStudies.php" method="POST" onsubmit="return confirmation()" style="margin: 0;">
                              <input name="4576" type="hidden" value="<?php echo $row[0]; ?>">
                              <button type="submit" class="btn btn-sm btn-danger" name="5489"><i class="bi bi-trash"></i></button>
                            </form>
                          </div>
                        </td>
                      </tr>

                    <?php } ?>

                  </tbody>
                </table>
              </div>


              <!------------------------------- Subida de archivos Soporte Estudios -------------------------------------------------->
              <!-- <div class="row">

                <div class="col-md-6">

                  <form action="crud/insertDocuments.php" method="POST" enctype="multipart/form-data" onsubmit="return mensajeActualizacion()">

                    <div class="row">

                      <div class="form-group col-md-8">

                        <input name="tipo" type="hidden" value="2">
                        <label for="file" class="form-label"> Soporte Estudios</label>
                        <input class="form-control" type="file" name="file" id="file" accept=".pdf">

                      </div>

                      <div class="form-group col-md-4 align-self-end">

                        <button type="submit" class="btn btn-success">Aceptar</button>

                      </div>



                    </div>
                  </form>
                </div>

                <div class="col">

                  <?php $document = selectDocumentos(2); ?>

                </div>

              </div> -->

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>

    <div class="container p-2" id="tarjetaExperiencia">
      <div class="row justify-content-center">
        <div class="col">
          <div class="card">
            <div class="card-header">Experiencia Laboral</div>
            <div class="card-body">

              <form action="crud/insertExperience.php" method="POST" enctype="multipart/form-data">

                <div class="row">

                  <div class="form-group col-md-6">
                    <label for="entidad">Entidad</label>
                    <input id="entidad" name="entidad" type="text" class="form-control" value="" required>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="fecha_inicio">Fecha de Inicio Laboral</label>
                    <input id="fecha_inicio" name="fecha_inicio" type="date" class="form-control" value="" required>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="fecha_final">Fecha de Finalizacion Laboral</label>
                    <input id="fecha_final" name="fecha_final" type="date" class="form-control" value="">
                  </div>

                </div>

                <div class="row">

                  <div class="form-group col-md-11">

                    <label for="funcion">Funciones desempeñadas</label>
                    <input id="funcion" name="funcion" type="text" class="form-control" value="" required>

                  </div>
                  <div class="row">

                    <div class="col-md-6">

                      <form action="crud/insertExperience.php" method="POST" enctype="multipart/form-data" onsubmit="return mensajeActualizacion()">

                        <div class="row">

                          <div class="form-group col-md-8">

                            <input name="tipo" type="hidden" value="3">
                            <label for="file" class="form-label"> Soporte Experiencia Realizada</label>
                            <input class="form-control" type="file" name="file" id="file" accept=".pdf" required>

                          </div>

                          <!-- <div class="form-group col-md-4 align-self-end">

                            <button type="submit" class="btn btn-success">Aceptar</button>

                          </div> -->



                        </div>
                      </form>
                    </div>

                    <!-- <div class="col">

                      <?php $document = selectDocumentos(3); ?>

                    </div>

                  </div> -->

                    <div class="form-group col-md-1 align-self-end">

                      <button type="submit" name="4040" class="btn btn-success">Aceptar</button>

                    </div>

                  </div>

              </form>

              <div class="table-responsive pt-4">
                <table class="table">
                  <thead class="table-dark">
                    <tr>
                      <th scope="col">Entidad</th>
                      <th scope="col">Funciones</th>
                      <th scope="col" width="10%" style="text-align: center">Duracion</th>
                      <th scope="col" width="10%" style="text-align: center">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                    $query = connection()->query("SELECT * FROM `experiencia` WHERE experiencia.usuario_id=$id");

                    while ($row = mysqli_fetch_array($query)) {

                      $experience = TRUE;
                      $date1 = new DateTime($row['fecha_inicio']);
                      $date2 = new DateTime($row['fecha_final']);
                      $diff = $date1->diff($date2);
                      $date = round(($diff->y * 12) + $diff->m + ($diff->d / 28), 2) . " Meses";
                      $path = "storage/" . $documento . "/experience/" . $row['file']; ?>

                      <tr>
                        <th scope="row"><?php echo $row['entidad']; ?></th>
                        <td><?php echo $row['funcion']; ?></td>
                        <td width="10%" style="text-align: center"><?php echo $date; ?></td>
                        <td style="text-align: center" colspan="2">
                          <button type="button" class="btn btn-sm btn-info" onclick="window.open('<?php echo $path; ?>', '_blank');">
                            <i class="bi bi-file-earmark-check"></i>
                          </button>
                          <form action="crud/deleteExperience.php" method="POST" onsubmit="return confirmation()" style="display:inline;">
                            <input name="4576" type="hidden" value="<?php echo $row[0]; ?>">
                            <button type="submit" class="btn btn-sm btn-danger" name="5698">
                              <i class="bi bi-trash"></i>
                            </button>
                          </form>
                        </td>
                      </tr>


                    <?php } ?>
                  </tbody>
                </table>
              </div>

              <!-------------------- Subida de Documetos de Soporte de Experiencia Laboral -------------------------------->
              <!-- <div class="row">

                <div class="col-md-6">

                  <form action="crud/insertDocuments.php" method="POST" enctype="multipart/form-data" onsubmit="return mensajeActualizacion()">

                    <div class="row">

                      <div class="form-group col-md-8">

                        <input name="tipo" type="hidden" value="3">
                        <label for="file" class="form-label"> Soporte Experiencia</label>
                        <input class="form-control" type="file" name="file" id="file" accept=".pdf">

                      </div>

                      <div class="form-group col-md-4 align-self-end">

                        <button type="submit" class="btn btn-success">Aceptar</button>

                      </div>



                    </div>
                  </form>
                </div>

                <div class="col">

                  <?php $document = selectDocumentos(3); ?>

                </div>

              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>


  <?php };

  if ($studies == TRUE && $experience == TRUE) { ?>

    <div class="container p-2" id="tarjetaMaterias">
      <div class="row justify-content-center">
        <div class="col">
          <div class="card">

            <h5 class="card-header">Materias Seleccionadas</h5>

            <div class="card-body">

              <div class="alert alert-success" role="alert">

                <strong>Notas: </strong>

                <ul>
                  <li>En esta tabla apareceran todas las materias que usted esta disponible a enseñar.</li>
                  <li>Verifique que selecciono por lo menos una materia para culminar el proceso.</li>
                </ul>

              </div>

              <p>

              <table id="tableSelectedSubjects" class="table">
                <thead>
                  <tr>
                    <th style="text-align: center; font-weight: bold">Eliminar</th>
                    <th>Facultad</th>
                    <th>Programa</th>
                    <th>Codigo</th>
                    <th>Materia</th>
                  </tr>
                </thead>
              </table>

              <p>

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container p-2" id="tarjetaMaterias" style="min-height: 700px;">
      <div class="row justify-content-center">
        <div class="col">
          <div class="card">

            <h5 class="card-header">Banco de Materias</h5>

            <div class="card-body">

              <div class="alert alert-success" role="alert">

                <strong>Notas: </strong>

                <ul>
                  <li>El filtro "Buscar" es multicolumna y parcial.</li>
                  <li>Recuerde limpiar el filtro "Buscar" y mover las flechas de la columna "Seleccionar" para ver el estado de las materias.</li>
                  <li>Al dar click en el boton dentro de la columna "Seleccionar" este cambiara a verde y quiere decir que usted esta disponible para que se le asigne esta materia.</li>
                </ul>

              </div>

              <p>

              <table id="tableSubjects" class="table">
                <thead>
                  <tr>
                    <th style="text-align: center">Seleccionar</th>
                    <th>Facultad</th>
                    <th>Programa</th>
                    <th>Codigo</th>
                    <th>Materia</th>
                  </tr>
                </thead>
              </table>

              <p>

            </div>
          </div>
        </div>
      </div>
    </div>

  <?php } ?>

</body>

<script>
  function confirmation() {

    if (confirm("¿Realmente desea eliminar?")) {
      return true;
    }
    return false;
  }

  $('#tableSubjects').DataTable({
    ajax: 'crud/getSubjects.php',

    "columnDefs": [

      {
        targets: 1,
        className: 'dt-head-center'
      },

      {
        "targets": 0,
        "className": "text-center",
        "width": "10%",
      },

      {
        "targets": 3,
        "className": "text-center",
        "width": "10%",
      }
    ],

    columns: [{
        data: 'acciones'
      },
      {
        data: 'facultad'
      },
      {
        data: 'programa'
      },
      {
        data: 'codigoMateria'
      },
      {
        data: 'materia'
      }

    ],

    stateSave: true,

    language: {
      url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
    },
  });

  $('#tableSelectedSubjects').DataTable({
    ajax: 'crud/getSelectedSubjects.php',

    "columnDefs": [

      {
        targets: 1,
        className: 'dt-head-center'
      },

      {
        "targets": 0,
        "className": "text-center",
        "width": "10%",
      },

      {
        "targets": 3,
        "className": "text-center",
        "width": "10%",
      }
    ],

    columns: [{
        data: 'acciones'
      },
      {
        data: 'facultad'
      },
      {
        data: 'programa'
      },
      {
        data: 'codigoMateria'
      },
      {
        data: 'materia'
      }

    ],

    stateSave: true,

    language: {
      url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
    },
  });
</script>

</html>