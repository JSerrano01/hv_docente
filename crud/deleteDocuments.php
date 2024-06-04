<?php

$allowedRoles = ['administrador','docente'];

include('../access.php');
include('../database.php');

if(isset($_POST['tipo']) && isset($_POST['5489'])){

    // Obtener el nombre del archivo a eliminar de la base de datos
    $result = connection()->query("SELECT `file` FROM `documentos` WHERE `usuario_id`='$_SESSION[id]' AND tipo_id='$_POST[tipo]'");
    $row = $result->fetch_assoc();
    $fileName = $row['file'];

    // Eliminar el registro de la base de datos
    connection()->query("DELETE FROM `documentos` WHERE `usuario_id`='$_SESSION[id]' AND tipo_id='$_POST[tipo]'");

    // Ruta del archivo a eliminar
    $filePath = '../storage/'.$_SESSION["usuario"].'/documents/'.$fileName;

    // Verificar si el archivo existe y eliminarlo
    if (file_exists($filePath)) {
        unlink($filePath); // Eliminar el archivo
    }

}

header("Location: ../profile.php");
exit();
