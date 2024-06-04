<?php
$allowedRoles = ['administrador'];

include('../access.php');
include('../database.php');

$html= '

    <form action="crud/updateRole.php" method="POST">

        <div class="row p-1">

            <select class="form-select p-1" name="Role">
            <option selected>Nuevo Rol</option>';

            $result = connection()->query("SELECT *  FROM `maestra_roles`");

            while($row = mysqli_fetch_assoc($result)){

                $html .= '<option value="'.$row['id'].'">'.$row['clase'].'</option>';};

            $html .='</select>

        </div>';

$result = connection()->query("SELECT usuarios.numero_documento, usuarios.email, maestra_roles.clase, perfiles.primer_nombre, perfiles.segundo_nombre, perfiles.primer_apellido, perfiles.segundo_apellido, usuarios.rol_id  FROM `usuarios` 
JOIN `maestra_roles` ON usuarios.rol_id = maestra_roles.id
JOIN `perfiles` ON usuarios.id = perfiles.usuario_id");

$emparray = array();

    while($row = mysqli_fetch_assoc($result))
    {
        $temp = $html;

        $temp.='<input type="hidden" id="numero_documento" name="numero_documento" value="'.$row['numero_documento'].'">

            <div class="row p-1">

                <button type="summit" class="btn btn-sm btn-danger">Cambiar</button>

            </div>

        </form>';

        if (empty($row['segundo_nombre']) and empty($row['segundo_apellido'])){

            $nombre = $row['primer_nombre']." ".$row['primer_apellido'];
        }

        else if (empty($row['segundo_nombre']) ){

            $nombre = $row['primer_nombre']." ".$row['primer_apellido']." ".$row['segundo_apellido'];
        }

        else if (empty($row['segundo_apellido']) ){

            $nombre = $row['primer_nombre']." ".$row['segundo_nombre']." ".$row['primer_apellido'];
        }

        else{

            $nombre = $row['primer_nombre']." ".$row['segundo_nombre']." ".$row['primer_apellido']." ".$row['segundo_apellido'];
        }
        
        $emparray['data'][] = array(
            
            'cedula'=> $row['numero_documento'], 
            'nombre'=> $nombre, 
            'rol'=> $row['clase'],
            'acciones'=> $temp,       
        
        );
    }

echo json_encode($emparray);
mysqli_close($connection);
?>