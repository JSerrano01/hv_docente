<?php

function connection(){

    // $connection = new mysqli('10.3.1.110','root','WNeqRzh!nHrfA9d**K!^','hvdocente',3306);

    $connection = new mysqli('127.0.0.1','root','','hvdocente');

    if ($connection->connect_error) {die("Connection failed: " . $connection->connect_error);}
    
    return $connection;
}

$connection=connection();

?>