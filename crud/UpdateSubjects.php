<?php

#$allowedRoles = ['administrador','docente'];

#include('../access.php');
include('../database.php');
include('../env.php');

$_ENV["ACCESS_TOKEN_ACCADEMIA"];

$url_path = 'https://apps1.colmayor.edu.co/crud-accademia/selectSubject.php'; 
  
$data = array('ACCESS_TOKEN' => $_ENV["ACCESS_TOKEN_ACCADEMIA"]); 

$query = http_build_query($data);

$options = array( 
    'http' => array( 
        'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
                    "Content-Length: ".strlen($query)."\r\n".
                    "User-Agent:MyAgent/1.0\r\n",
        'method' => 'POST', 
        'content' => $query ) 
); 

$stream = stream_context_create($options); 
$result = file_get_contents($url_path, false, $stream); 
$json = json_decode($result, true);
$values ="";

foreach ( $json["data"] as $idx=>$json ) {
    if(is_array($json))
        {   $values .= "(";
            foreach($json as $iidx=>$jjson) 
            {
                #echo $iidx.":".$jjson;
                $values .= '"'.$jjson.'",';

            }

            $values = trim($values, ',');
            $values .= "),";
        }
        else
        {
            echo $idx.":".$json;
        }
    }

$values = trim($values, ',');

connection()->query("TRUNCATE TABLE `maestra_materias`");

connection()->query("INSERT INTO `maestra_materias` (`codigo`,`materia`,`programa`,`dependencia`) VALUES ".$values);

?>