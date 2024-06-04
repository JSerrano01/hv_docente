<?php

#------SE COLOCA TIMEZONE ACTUAL----------------
date_default_timezone_set('America/Bogota');

#-------INICIADOR DE SESIONES CON ID USUARIO----------------
session_start();
if (!array_key_exists('id', $_SESSION)) {
   header('Location: index.php');
   die;
}

#--------------------------VALIDA EL ROL DE ACCESO DE EL USUARIO-----------------------------
if (!array_key_exists('role', $_SESSION) || !in_array($_SESSION['role'], $allowedRoles)) {
   header('Location: index.php');
   die;
}

#------------------PARAMETROS PARA INICIO DE SESION--------------------------
$id = $_SESSION['id'];
$documento = $_SESSION['usuario'];
$document = FALSE;
