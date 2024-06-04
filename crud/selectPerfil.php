<?php

$allowedRoles = ['administrador', 'coordinador'];

include('../access.php');
include('../database.php');

$connection = connection();

$query = "SELECT m.usuario_id AS idUsuario, m.materia_id AS idMateria, mm.dependencia, mm.codigo, mm.materia, p.primer_nombre, p.primer_apellido, c.is_enable FROM materias m JOIN perfiles p ON m.usuario_id = p.usuario_id LEFT JOIN convocatoria c ON m.usuario_id = c.usuario_id AND m.materia_id = c.materia_id AND c.is_enable = 1 JOIN maestra_materias mm ON m.materia_id = mm.codigo";

if ($stmt = $connection->prepare($query)) {
    $stmt->execute();
    $result = $stmt->get_result();
    
    $uniqueRecords = array();
    $emparray = array();

    while ($row = $result->fetch_assoc()) {
        $idUsuario = $row['idUsuario'];
        $idMateria = $row['idMateria'];

        // Genera una clave única para cada combinación de idUsuario e idMateria
        $uniqueKey = $idUsuario . '-' . $idMateria;

        // Si ya existe en el array de registros únicos, omite el registro actual
        if (!isset($uniqueRecords[$uniqueKey])) {
            $uniqueRecords[$uniqueKey] = $row;
        }
    }

    foreach ($uniqueRecords as $row) {
        $acciones = '';
        $idUsuario = htmlspecialchars($row['idUsuario'], ENT_QUOTES, 'UTF-8');
        $idMateria = htmlspecialchars($row['idMateria'], ENT_QUOTES, 'UTF-8');
        
        if ($row['is_enable'] == 0) {
            $acciones = '
            <form action="crud/insertCall.php" method="POST" onsubmit="return confirmacionAbrirConvocatoria()">
                <input name="usuario" type="hidden" value="' . $idUsuario . '">
                <input name="materia" type="hidden" value="' . $idMateria . '">
                <button type="submit" class="btn btn-sm btn btn-success" name="add" title="Agregar o abrir convocatoria"><i class="bi bi-person-plus"></i></button>
                <button type="button" class="btn btn-sm btn btn-success" title="Ver perfil" onclick="window.open(\'viewProfile.php?user=' . $idUsuario . '\');"><i class="bi bi-person-vcard"></i></button>
            </form>';
        } else {
            $acciones = '
            <form action="crud/insertCall.php" method="POST" onsubmit="return alertaParticipanteOcupado()">
                <input name="usuario" type="hidden" value="' . $idUsuario . '">
                <input name="materia" type="hidden" value="' . $idMateria . '">
                <button type="submit" class="btn btn-sm btn btn-danger" title="Este candidato ya está convocado"><i class="bi bi-file-lock"></i></button>
                <button type="button" class="btn btn-sm btn btn-success" title="Ver perfil" onclick="window.open(\'viewProfile.php?user=' . $idUsuario . '\');"><i class="bi bi-person-vcard"></i></button>
            </form>';
        }

        $emparray['data'][] = array(
            'facultad' => htmlspecialchars($row['dependencia'], ENT_QUOTES, 'UTF-8'),
            'codigo' => htmlspecialchars($row['codigo'], ENT_QUOTES, 'UTF-8'),
            'materia' => htmlspecialchars($row['materia'], ENT_QUOTES, 'UTF-8'),
            'candidato' => htmlspecialchars($row['primer_nombre'], ENT_QUOTES, 'UTF-8') . " " . htmlspecialchars($row['primer_apellido'], ENT_QUOTES, 'UTF-8'),
            'acciones' => $acciones,
        );
    }

    echo json_encode($emparray);

    $stmt->close();
} else {
    die('Consulta fallida: ' . $connection->error);
}

$connection->close();
?>
