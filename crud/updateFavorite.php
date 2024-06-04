<!DOCTYPE html>

<?php

$allowedRoles = ['administrador','coordinador'];

include('../access.php');
include('../database.php');

$result = connection()->query("SELECT * FROM `convocatoria` WHERE usuario_id='$_POST[usuario]' AND materia_id='$_POST[materia]' AND is_enable = 1");
$row = mysqli_fetch_assoc($result);

if ($row['is_favorite'] == 1){$enable=0;}

else{$enable=1;}

$result = connection()->query("UPDATE `convocatoria` SET `is_favorite`= '$enable' WHERE usuario_id='$_POST[usuario]' AND materia_id='$_POST[materia]' AND is_enable = 1");
header("Location: ../viewCall.php?materia=$_POST[materia]");

exit();

?>
