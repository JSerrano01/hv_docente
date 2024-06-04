<!DOCTYPE html>

<?php

$allowedRoles = ['administrador', 'coordinador'];

include('access.php');
include('database.php');
include('library/library.php');

?>

<html lang="en">

<head><?php include('head.php'); ?></head>

<body>

    <?php include('navbar.php');

    $onlyView = 1;
    $favorite = 0; ?>

    <div class="container p-2" id="tarjetaMaterias">

        <div class="row justify-content-center">
            <div class="col">
                <div class="card">

                    <?php
                    // Inicializar la variable $favorite
                    $favorite = 0;
                    $onlyView = 1;

                    // Consulta SQL
                    $result = connection()->query("SELECT * FROM `convocatoria` 
                                   JOIN `perfiles` ON convocatoria.usuario_id = perfiles.usuario_id
                                   JOIN `maestra_materias` ON convocatoria.materia_id = maestra_materias.codigo
                                   WHERE `coordinador_id` = '$_SESSION[id]' AND `serial_number` = '$_GET[serialNumber]' AND is_enable = 0 AND `materia_id` = '$_GET[materia]'");

                    // Array para almacenar registros únicos
                    $uniqueRecords = array();

                    while ($row = mysqli_fetch_array($result)) {
                        // Construir la clave única
                        $uniqueKey = $row['usuario_id'] . '-' . $row['materia_id'];

                        // Verificar si la clave única ya existe en el array
                        if (!isset($uniqueRecords[$uniqueKey])) {
                            // Si no existe, agregar el registro al array y actualizar $favorite
                            $uniqueRecords[$uniqueKey] = $row;
                            $favorite += $row['is_favorite'];
                        }
                    } // Fin del bucle while

                    // Ahora puedes mostrar los registros fuera del bucle foreach
                    foreach ($uniqueRecords as $row) {
                        if ($onlyView == 1) { ?>
                            <div class="card-header"><?php echo $row['codigo'] . " " . $row['materia']; ?></div>
                            <div class="card-body">
                                <div class="container">
                                    <?php $onlyView = 0; ?>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="row">
                            <div class="col m-1" style="text-align: center">
                                <?php echo $row['primer_nombre'] . ' ' . $row['primer_apellido']; ?>
                            </div>
                            <div class="col m-1" style="text-align: center">
                                <form action="crud/updateFavorite.php" method="POST">
                                    <input name="usuario" type="hidden" value="<?php echo $row['usuario_id'] ?>">
                                    <input name="materia" type="hidden" value="<?php echo $row['materia_id'] ?>">

                                    <?php if ($row['is_favorite'] == '1') { ?>
                                        <button type="submit" class="btn btn-sm btn btn-info" name="favorite" disabled><i class="bi bi-star-fill" style="color: #ffc107;"></i></button>
                                    <?php } else { ?>
                                        <button type="submit" class="btn btn-sm btn btn-info" name="favorite" disabled><i class="bi bi-star-fill"></i></button>
                                    <?php } ?>

                                    <button type="button" class="btn btn-sm btn btn-success" onclick="window.open('viewProfile.php?user=<?php echo $row['usuario_id'] ?>')"><i class="bi bi-person-vcard"></i></button>
                                </form>
                            </div>
                        </div>
                    <?php } // Fin del bucle foreach
                    ?>




                </div>
            </div>

        </div>
    </div>
    </div>

    </div>


</body>

<script>
    function messageError() {
        alert('Debe seleccionar un candidato');
    }

    function messageConfirmation() {

        if (confirm("¿Desea cerrar la convocatoria?")) {
            return true;
        }
        return false;
    }
</script>

</html>