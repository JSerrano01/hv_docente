<?php
$allowedRoles = ['administrador', 'docente', 'coordinador', 'reclutador'];
include('../database.php');
include('../access.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_email = $_POST['current_email'];
    $new_email = $_POST['new_email'];
    
    // Verificar si los campos no están vacíos
    if (!empty($current_email) && !empty($new_email)) {
        // Verificar el correo electrónico actual
        $query = "SELECT * FROM usuarios WHERE numero_documento = $documento AND email = '$current_email'";
        $result = mysqli_query($connection, $query);
        
        if (mysqli_num_rows($result) == 1) {
            // Verificar si el nuevo correo electrónico ya existe en la base de datos
            $query_check = "SELECT * FROM usuarios WHERE email = '$new_email'";
            $result_check = mysqli_query($connection, $query_check);
            
            if (mysqli_num_rows($result_check) == 0) {
                // El correo electrónico nuevo no existe en la base de datos, proceder con la actualización
                $query_update = "UPDATE usuarios SET email = '$new_email' WHERE numero_documento = $documento";
                $result_update = mysqli_query($connection, $query_update);
                
                if ($result_update) {
                    // Mostrar mensaje de éxito y recargar la página
                    echo "<script>alert('Correo electrónico actualizado correctamente.'); window.location.href = '../changeCredentials.php';</script>";
                } else {
                    // Mostrar mensaje de error y recargar la página
                    echo "<script>alert('Error al actualizar el correo electrónico.'); window.location.href = '../changeCredentials.php';</script>";
                }
            } else {
                // El nuevo correo electrónico ya existe en la base de datos, mostrar mensaje de error
                echo "<script>alert('El nuevo correo electrónico ya está registrado.'); window.location.href = '../changeCredentials.php';</script>";
            }
        } else {
            // Mostrar mensaje de error y recargar la página
            echo "<script>alert('El correo electrónico actual no es correcto.'); window.location.href = '../changeCredentials.php';</script>";
        }
    } else {
        // Mostrar mensaje de error y recargar la página
        echo "<script>alert('Por favor, completa todos los campos.'); window.location.href = '../changeCredentials.php';</script>";
    }
}

mysqli_close($connection);
?>

