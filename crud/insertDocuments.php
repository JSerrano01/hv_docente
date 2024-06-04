<?php

$allowedRoles = ['administrador','coordinador','docente'];

include('../access.php');
include('../database.php');

if (isset($_POST['tipo']) && $_POST['tipo']=='1' && isset($_FILES['file']) && !empty($_FILES['file']['name'])){

    $tempfileExtension = explode(".", $_FILES['file']['name']);
    $fileExtension = strtolower(end($tempfileExtension));
    $newFileName = md5(time() . $_FILES['file']['name']) .'.'. strtolower($fileExtension);
    $newFilePath = '../storage/'.$_SESSION["usuario"].'/documents';

    if (!file_exists($newFilePath)){mkdir($newFilePath, 0777, true);}

    if(move_uploaded_file($_FILES['file']['tmp_name'], $newFilePath.'/'.$newFileName));{

        connection()->query("INSERT INTO `documentos` (`usuario_id`,`tipo_id`,`file`) VALUES ('$_SESSION[id]','$_POST[tipo]','$newFileName') ON DUPLICATE KEY UPDATE `file`='$newFileName'");

    }
}

// if (isset($_POST['tipo']) && $_POST['tipo']=='2' && isset($_FILES['file']) && !empty($_FILES['file']['name'])){

//     $tempfileExtension = explode(".", $_FILES['file']['name']);
//     $fileExtension = strtolower(end($tempfileExtension));
//     $newFileName = md5(time() . $_FILES['file']['name']) .'.'. strtolower($fileExtension);
//     $newFilePath = '../storage/'.$_SESSION["usuario"].'/studies';

//     if (!file_exists($newFilePath)){mkdir($newFilePath, 0777, true);}

//     if(move_uploaded_file($_FILES['file']['tmp_name'], $newFilePath.'/'.$newFileName));{

//         connection()->query("INSERT INTO `documentos` (`usuario_id`,`tipo_id`,`file`) VALUES ('$_SESSION[id]','$_POST[tipo]','$newFileName') ON DUPLICATE KEY UPDATE `file`='$newFileName'");

//     }
// }

// if (isset($_POST['tipo']) && $_POST['tipo']=='3' && isset($_FILES['file']) && !empty($_FILES['file']['name'])){

//     $tempfileExtension = explode(".", $_FILES['file']['name']);
//     $fileExtension = strtolower(end($tempfileExtension));
//     $newFileName = md5(time() . $_FILES['file']['name']) .'.'. strtolower($fileExtension);
//     $newFilePath = '../storage/'.$_SESSION["usuario"].'/experience';

//     if (!file_exists($newFilePath)){mkdir($newFilePath, 0777, true);}

//     if(move_uploaded_file($_FILES['file']['tmp_name'], $newFilePath.'/'.$newFileName));{

//         connection()->query("INSERT INTO `estudios` (`usuario_id`,`tipo`, `fecha_graduacion`, `titulo`, `file`) VALUES ('$_SESSION[id]','$_POST[tipo]', '$_POST[fecha_graduacion]', '$_POST[titulo]','$newFileName') ON DUPLICATE KEY UPDATE `file`='$newFileName'");

//     }
// }

header("Location: ../profile.php");

exit();

?>