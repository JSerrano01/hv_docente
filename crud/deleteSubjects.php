<?php

$allowedRoles = ['administrador','coordinador','docente'];

include('../access.php');
include('../database.php');

$result = connection()->query("DELETE FROM `materias` WHERE `usuario_id` LIKE '$_SESSION[id]' AND `materia_id` LIKE '$_POST[materia]'");

header("Location: ../profile.php#tarjetaMaterias");

exit();