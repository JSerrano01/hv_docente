<?php

$allowedRoles = ['administrador','coordinador','docente'];

include('../access.php');
include('../database.php');

$query = connection()->query("INSERT INTO `perfiles` (`usuario_id`,`primer_nombre`,`segundo_nombre`,`primer_apellido`,`segundo_apellido`,`correo`,`nacimiento`,`documento_id`,`celular`,`fijo`,`direccion`,`ciudad_id`,`departamento_id`) 
                              VALUES ('$_SESSION[id]','$_POST[primer_nombre]','$_POST[segundo_nombre]','$_POST[primer_apellido]','$_POST[segundo_apellido]','$_POST[correo]','$_POST[nacimiento]','$_POST[documento]','$_POST[celular]','$_POST[fijo]','$_POST[direccion]','$_POST[ciudad]','$_POST[departamento]')
                              ON DUPLICATE KEY UPDATE                           
                              `primer_nombre` = '$_POST[primer_nombre]',
                              `segundo_nombre` = '$_POST[segundo_nombre]',
                              `primer_apellido` = '$_POST[primer_apellido]',
                              `segundo_apellido` = '$_POST[segundo_apellido]',
                              `correo` = '$_POST[correo]',
                              `nacimiento` = '$_POST[nacimiento]',
                              `documento_id` = '$_POST[documento]',             
                              `celular` = '$_POST[celular]',
                              `fijo` = '$_POST[fijo]',
                              `direccion` = '$_POST[direccion]',
                              `ciudad_id` = '$_POST[ciudad]',
                              `departamento_id` = '$_POST[departamento]'
                              ");

header("Location: ../profile.php");

exit();

?>