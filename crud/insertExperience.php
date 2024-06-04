<?php

$allowedRoles = ['administrador','coordinador','docente'];

include('../access.php');
include('../database.php');

$data = array($_SESSION["id"],$_POST["entidad"],$_POST["fecha_inicio"],$_POST["fecha_final"],$_POST["funcion"]);

//if (isset($_POST['4040']) && isset($_FILES['file'])){

if (isset($_POST['4040'])){
    
    #print_r($_FILES);

    $tempfileExtension = explode(".", $_FILES['file']['name']);
    $fileExtension = strtolower(end($tempfileExtension));
    $newFileName = md5(time() . $_FILES['file']['name']) .'.'. strtolower($fileExtension);
    $newFilePath = '../storage/'.$_SESSION["usuario"].'/experience';

    $data[] = $newFileName;

    if (!file_exists($newFilePath)){mkdir($newFilePath, 0777, true);}

    if(move_uploaded_file($_FILES['file']['tmp_name'], $newFilePath.'/'.$newFileName));{

        connection()->query("INSERT INTO `experiencia` (`usuario_id`,`entidad`,`fecha_inicio`,`fecha_final`,`funcion`,`file`) VALUES ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]')");

    }
}

header("Location: ../profile.php#tarjetaExperiencia");

exit();