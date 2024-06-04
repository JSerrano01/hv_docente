<?php

$allowedRoles = ['administrador','coordinador'];

include('../access.php');
include('../database.php');

$row = mysqli_fetch_assoc(connection()->query("SELECT *, MAX(serial_number) AS serial_number_max FROM `convocatoria` LIMIT 1"));

$serialNumber=$row['serial_number_max'] + 1;

$query = connection()->query("UPDATE `convocatoria` SET `is_enable`= 0,serial_number=$serialNumber WHERE coordinador_id='$_SESSION[id]' AND materia_id='$_POST[materia]' AND is_enable = 1");

header("Location: ../call.php");

?>