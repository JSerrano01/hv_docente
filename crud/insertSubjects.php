<?php

$allowedRoles = ['administrador','coordinador','docente'];

include('../access.php');
include('../database.php');

$query = connection()->query("INSERT IGNORE INTO `materias` (`usuario_id`,`materia_id`) VALUES ('$_SESSION[id]','$_POST[materia]')");

header("Location: ../profile.php#tarjetaMaterias");

exit();

?>