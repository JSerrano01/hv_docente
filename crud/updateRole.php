<!DOCTYPE html>

<?php

$allowedRoles = ['administrador'];

include('../access.php');
include('../database.php');

$result = connection()->query("UPDATE `usuarios` SET `rol_id`= '$_POST[Role]' WHERE numero_documento='$_POST[numero_documento]'");

header("Location: ../administrator.php");

?>
