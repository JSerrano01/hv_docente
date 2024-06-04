<?php

$allowedRoles = ['administrador', 'coordinador'];

include('../access.php');
include('../database.php');

// Obtener la conexión
$connection = connection();

// echo($_SESSION['id']);

// $result = connection()->query("SELECT *, COUNT(*) AS `cnt` FROM `convocatoria` 
//     JOIN `maestra_materias` ON convocatoria.materia_id = maestra_materias.codigo
//     WHERE `coordinador_id` = '$_SESSION[id]' AND `is_enable` = 0
//     GROUP BY `serial_number`
//     ");

// Consulta preparada
$query = "
    SELECT 
        c.serial_number, 
        mm.codigo, 
        mm.dependencia, 
        mm.materia 
    FROM 
        convocatoria c 
    JOIN 
        maestra_materias mm ON c.materia_id = mm.codigo 
    WHERE 
        c.coordinador_id = ? 
        AND c.is_enable = 0 
    GROUP BY 
        c.serial_number
";

if ($stmt = $connection->prepare($query)) {
    // Vincular el parámetro
    $stmt->bind_param("i", $_SESSION['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $emparray = array();

    while ($row = $result->fetch_assoc()) {
        $serialNumber = htmlspecialchars($row['serial_number'], ENT_QUOTES, 'UTF-8');
        $codigo = htmlspecialchars($row['codigo'], ENT_QUOTES, 'UTF-8');
        $facultad = htmlspecialchars($row['dependencia'], ENT_QUOTES, 'UTF-8');
        $materia = htmlspecialchars($row['materia'], ENT_QUOTES, 'UTF-8');

        $acciones = '
            <form action="viewRecord.php" method="GET">
                <input name="serialNumber" type="hidden" value="' . $serialNumber . '">
                <input name="materia" type="hidden" value="' . $codigo . '">
                <button type="submit" class="btn btn-sm btn-success" title="Abrir Historial">
                    <i class="bi bi-archive"></i>
                </button>
            </form>
        ';

        $emparray['data'][] = array(
            'serial_number' => $serialNumber,
            'codigo' => $codigo,
            'facultad' => $facultad,
            'materia' => $materia,
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
