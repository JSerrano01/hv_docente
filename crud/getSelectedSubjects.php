<?php

$allowedRoles = ['administrador','docente','coordinador'];

include('../access.php');
include('../database.php');

$result = connection()->query("SELECT * FROM `maestra_materias` JOIN `materias` ON maestra_materias.codigo = materias.materia_id WHERE materias.usuario_id = '$_SESSION[id]' GROUP BY codigo UNION SELECT * FROM `maestra_materias_mt` JOIN `materias` ON maestra_materias_mt.codigo = materias.materia_id WHERE materias.usuario_id = '$_SESSION[id]' GROUP BY codigo");

$emparray = array();

while($row = mysqli_fetch_assoc($result)){

    $emparray['data'][] = array(
    
        'facultad'=> $row['dependencia'], 
        'programa'=> $row['programa'],
        'codigoMateria'=> $row['codigo'], 
        'materia'=> $row['materia'],
        'acciones'=> '<form action="crud/deleteSubjects.php" method="POST">
        <input type="hidden" value="0">
        <input name="materia" type="hidden" value="'.$row['codigo'].'">
        <button type="submit" class="btn btn-sm btn btn-danger"><i class="bi bi-bookmark-dash"></i></button>
        </form>',         
    
    );
}

echo json_encode($emparray);
mysqli_close($connection);

?>