<?php

$allowedRoles = ['administrador','reclutador'];

include('../access.php');
include('../database.php');

$result = connection()->query("SELECT *, COUNT(*) AS `cnt` FROM `convocatoria` 
    JOIN `maestra_materias` ON convocatoria.materia_id = maestra_materias.codigo
    WHERE `is_enable` = 1 GROUP BY `Materia`");

$emparray = array();

    while($row = mysqli_fetch_assoc($result))
    {
        
        $emparray['data'][] = array(
            
            'codigo'=> $row['codigo'], 
            'facultad'=> $row['dependencia'], 
            'materia'=> $row['materia'], 
            'ncandidatos'=> $row['cnt'],
            'acciones'=> '<div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-auto">

                        <form class="d-inline" action="viewCall.php?" >
                        <input name="materia" type="hidden" value="'.$row['materia_id'].'">
                        <button type="submit" class="btn btn-sm btn btn-success" title="Ver convocatoria"><i class="bi bi-card-list"></i></button>
                        </form>
                
                        <form class="d-inline" action="call.php" onsubmit="return alertaEliminacionConvocatoria()">
                        <input name="materia" type="hidden" value="'.$row['materia_id'].'">
                        <button type="submit" class="btn btn-sm btn btn-danger" name="delete" title="Eliminar convocatoria" ><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>',          
        
        );
    }

echo json_encode($emparray);
mysqli_close($connection);

?>