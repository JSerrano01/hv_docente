<?php

$allowedRoles = ['administrador', 'coordinador'];

include('../access.php');
include('../database.php');

// Obtener la conexión
$connection = connection();

// Consulta preparada
$query = "
    SELECT 
        mm.codigo, 
        mm.dependencia, 
        mm.materia, 
        COUNT(*) AS cnt 
    FROM 
        convocatoria c 
    JOIN 
        maestra_materias mm ON c.materia_id = mm.codigo 
    WHERE 
        c.coordinador_id = ? 
        AND c.is_enable = 1 
    GROUP BY 
        mm.codigo, mm.dependencia, mm.materia
";

if ($stmt = $connection->prepare($query)) {
    // Vincular el parámetro
    $stmt->bind_param("i", $_SESSION['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $uniqueRecords = array();
    $emparray = array();

    while ($row = $result->fetch_assoc()) {
        $codigo = $row['codigo'];
        $materia = $row['materia'];

        // Genera una clave única para cada combinación de codigo y materia
        $uniqueKey = $codigo . '-' . $materia;

        // Si ya existe en el array de registros únicos, omite el registro actual
        if (!isset($uniqueRecords[$uniqueKey])) {
            $uniqueRecords[$uniqueKey] = $row;
        }
    }

    foreach ($uniqueRecords as $row) {
        $codigo = htmlspecialchars($row['codigo'], ENT_QUOTES, 'UTF-8');
        $facultad = htmlspecialchars($row['dependencia'], ENT_QUOTES, 'UTF-8');
        $materia = htmlspecialchars($row['materia'], ENT_QUOTES, 'UTF-8');
        $ncandidatos = htmlspecialchars($row['cnt'], ENT_QUOTES, 'UTF-8');

        $acciones = '
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-auto">
                        <form class="d-inline" action="viewCall.php" method="GET">
                            <input name="materia" type="hidden" value="' . $codigo . '">
                            <button type="submit" class="btn btn-sm btn-success" title="Ver convocatoria">
                                <i class="bi bi-card-list"></i>
                            </button>
                        </form>
                        <form class="d-inline" action="crud/deleteCall.php" method="POST" onsubmit="return alertaEliminacionConvocatoria()">
                            <input name="materia" type="hidden" value="' . $codigo . '">
                            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar convocatoria">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        ';

        $emparray['data'][] = array(
            'codigo' => $codigo,
            'facultad' => $facultad,
            'materia' => $materia,
            'ncandidatos' => $ncandidatos,
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
