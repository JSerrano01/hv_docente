<?php
$allowedRoles = ['administrador', 'docente', 'coordinador', 'reclutador'];
include('../database.php');
include('../access.php');

if (!empty($_POST['current_password']) && !empty($_POST['new_password'])) {
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);

    // Verificar la contraseña actual
    $query = "SELECT * FROM usuarios WHERE numero_documento = $documento AND password = '$current_password'";
    $result = mysqli_query($connection, $query);
    
    if (mysqli_num_rows($result) == 1) {
        // La contraseña actual es correcta, actualizar la contraseña
        $query = "UPDATE usuarios SET password = '$new_password' WHERE numero_documento = $documento";
        $result = mysqli_query($connection, $query);
        
        if ($result) {
            // Mostrar mensaje de éxito y recargar la página
            echo "<script>alert('Contraseña actualizada correctamente.'); window.location.href = '../changeCredentials.php';</script>";
        } else {
            // Mostrar mensaje de error y recargar la página
            echo "<script>alert('Error al actualizar la contraseña.'); window.location.href = '../changeCredentials.php';</script>";
        }
    } else {
        // Mostrar mensaje de error y recargar la página
        echo "<script>alert('La contraseña actual no es correcta.'); window.location.href = '../changeCredentials.php';</script>";
    }
} else {
    // Mostrar mensaje de error y recargar la página
    echo "<script>alert('Por favor, completa todos los campos.'); window.location.href = '../changeCredentials.php';</script>";
}

mysqli_close($connection);
?>