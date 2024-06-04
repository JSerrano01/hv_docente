<?php

$allowedRoles = ['administrador','coordinador'];

include('../access.php');
include('../database.php');


if(isset($_POST['add'])){

    $query = connection()->query("SELECT * FROM `convocatoria` WHERE `serial_number` LIKE 0 AND `coordinador_id` LIKE '$_SESSION[id]' AND `usuario_id` LIKE '$_POST[usuario]' AND `materia_id` LIKE '$_POST[materia]'");

    if(mysqli_num_rows($query)==0){

        $query = connection()->query("INSERT IGNORE INTO `convocatoria` (`coordinador_id`,`usuario_id`,`materia_id`) VALUES ('$_SESSION[id]','$_POST[usuario]','$_POST[materia]')");
    
    }

}

    header("Location: ../call.php");
    
    exit();




