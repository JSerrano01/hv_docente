<?php

$allowedRoles = ['administrador','coordinador','docente'];

include('../access.php');
include('../database.php');

$tempfileExtension = explode(".", $_FILES['file']['name']);
    $fileExtension = strtolower(end($tempfileExtension));
    $newFileName = md5(time() . $_FILES['file']['name']) .'.'. strtolower($fileExtension);
    $newFilePath = '../storage/'.$_SESSION["usuario"].'/studies';

    if (!file_exists($newFilePath)){mkdir($newFilePath, 0777, true);}

    if(move_uploaded_file($_FILES['file']['tmp_name'], $newFilePath.'/'.$newFileName));{

        connection()->query("INSERT INTO `estudios` (`usuario_id`,`tipo`,`fecha_graduacion`,`titulo`, `file`) VALUES ('$_SESSION[id]','$_POST[tipo]','$_POST[fecha_graduacion]','$_POST[titulo]', '$newFileName')");
    }

header("Location: ../profile.php#tarjetaEstudios");

exit();

?>