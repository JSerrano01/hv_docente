<?php

$allowedRoles = ['administrador','coordinador','docente'];

include('../access.php');
include('../database.php');

if(isset($_POST['5489']) && isset($_POST['4576'])) {

    $id = $_POST['4576'];

    // Primero, obtenemos el nombre del archivo que queremos eliminar
    $query = connection()->query("SELECT file FROM `estudios` WHERE id=$id");
    $fileToDelete = $query->fetch_assoc()['file'];

    // Luego, eliminamos el registro de la base de datos
    connection()->query("DELETE FROM `estudios` WHERE id=$id");

    // Finalmente, eliminamos el archivo del sistema
    $filePath = '../storage/'.$_SESSION["usuario"].'/studies/'.$fileToDelete;
    if(file_exists($filePath)) {
        unlink($filePath); // Esto eliminará el archivo si existe
    } else {
        // Aquí puedes manejar el caso en el que el archivo no existe
        // Puede ser una buena idea registrar un mensaje de error o hacer algo apropiado
    }

}

header("Location: ../profile.php#tarjetaEstudios");
exit();

?>
