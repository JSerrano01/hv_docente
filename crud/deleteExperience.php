<?php

$allowedRoles = ['administrador', 'coordinador', 'docente'];

include('../access.php');
include('../database.php');

if (isset($_POST['5698']) && isset($_POST['4576'])) {
    $id = $_POST['4576'];

    // Obtener el nombre del archivo asociado a la experiencia
    $fileQuery = connection()->query("SELECT file FROM `experiencia` WHERE id=$id");
    $fileRow = $fileQuery->fetch_assoc();
    $fileName = $fileRow['file'];

    // Eliminar el registro de la experiencia
    $deleteQuery = connection()->query("DELETE FROM `experiencia` WHERE id=$id");

    if ($deleteQuery) {
        // Eliminar el archivo del servidor si existe
        $filePath = '../storage/'.$_SESSION["usuario"].'/experience/'.$fileName;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}

header("Location: ../profile.php");

exit();
