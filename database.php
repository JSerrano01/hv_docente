<?php

#-----------------------------------CONEXION A LA BASE DE DATOS--------------------------------------------
function connection(){

    if(gethostname() == "T35040"){

        #--------------------------CONEXION A BASE DE DATOS DE PRUEBAS-----------------------------
        $connection = new mysqli('10.3.1.110','root','WNeqRzh!nHrfA9d**K!^','test_hvdocente',3306);

        if ($connection->connect_error) {die("Connection failed: " . $connection->connect_error);}
        
        return $connection;}
        
    else{
        #--------------------------CONEXION A BASE DE DATOS DE PRODUCCION-----------------------------
        $connection = new mysqli('10.3.1.110','root','WNeqRzh!nHrfA9d**K!^','hvdocente',3306);

        if ($connection->connect_error) {die("Connection failed: " . $connection->connect_error);}

        return $connection;
    }
}

$connection=connection();

?>