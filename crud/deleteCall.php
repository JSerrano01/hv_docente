<?php

$allowedRoles = ['administrador','docente'];

include('../access.php');
include('../database.php');

if(isset($_POST['materia'])){

    $query = connection()->query("DELETE FROM `convocatoria` WHERE `coordinador_id`='$_SESSION[id]' AND materia_id='$_POST[materia]'");

}

header("Location: ../call.php");

exit();