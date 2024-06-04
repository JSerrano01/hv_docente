<!DOCTYPE html>
<?php

#-------------------VALIDADOR DE PERMISOS DE USUARIO ACTUAL---------------------------
$allowedRoles = ['administrador', 'docente', 'coordinador', 'reclutador'];
$studies = FALSE;
$experience = FALSE;

include('access.php');
include('database.php');

?>

<html lang="en">

<head><?php include('head.php'); ?></head>

<body>

    <?php include('navbar.php'); ?>
<!-- ----------------------------------CONTENEDOR PARA CAMBIO DE CONTRASEÑA------------------------------------ -->
    <div class="container p-2">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Cambiar Contraseña</div>
                    <div class="card-body">
                        <form action="crud/updateCredentialsPassword.php" method="POST" onsubmit="return mensajeActualizacion()">
                            <div class="form-group">
                                <label for="current_password">Contraseña Actual:</label>
                                <input type="password" class="form-control" id="current_password" name="current_password" required>
                            </div>
                            <div class="form-group">
                                <label for="new_password">Nueva Contraseña:</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                            </div>
                            <div class="p-2">
                                <button type="submit" class="btn btn-success">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- ----------------------------------CONTENEDOR PARA CAMBIO DE EMAIL------------------------------------ -->
    <div class="container p-2">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Cambiar Email</div>
                    <div class="card-body">
                        <form action="crud/updateCredentialsEmail.php" method="POST" onsubmit="return mensajeActualizacion()">
                            <div class="form-group">
                                <label for="current_email">Correo Electrónico Actual:</label>
                                <input type="email" class="form-control" id="current_email" name="current_email" required>
                            </div>
                            <div class="form-group">
                                <label for="new_email">Nuevo Correo Electrónico:</label>
                                <input type="email" class="form-control" id="new_email" name="new_email" required>
                            </div>
                            <div class="p-2">
                                <button type="submit" class="btn btn-success">Actualizar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>