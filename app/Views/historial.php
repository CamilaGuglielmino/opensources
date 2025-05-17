<body>
<?php
function obtenerColorEstado($prioridad)
{
    switch ((int)$prioridad) {
  
        default:
            return 'bg-secondary'; // Desconocido
    }
}

function obtenerNombreEstado($estado)
{
    switch ((int)$estado) {
        case 1:
            return 'Definido';
        case 2:
            return 'En proceso';
        case 3:
            return 'Completada';
        default:
            return 'Eliminado';
    }
}

function obtenerNombrePrioridad($prioridad1)
{
    switch ((int)$prioridad1) {
        case 1:
            return 'Alta';
        case 2:
            return 'Normal';
        case 3:
            return 'Baja';
        default:
            return 'Desconocido';
    }
}

// Función para ordenar por prioridad (de menor a mayor: 1 = alta)
function ordenarPorPrioridad($a, $b)
{
    return (int)$a['prioridad'] - (int)$b['prioridad'];
}

// Función para ordenar por fecha de vencimiento
function ordenarPorFecha($a, $b)
{
    $fechaA = strtotime($a['fecha_vencimiento']);
    $fechaB = strtotime($b['fecha_vencimiento']);
    return $fechaA - $fechaB;
}

// Criterio de orden desde la URL (fecha o prioridad)
$criterioOrden = $_GET['orden'] ?? 'fecha';

$tareas = isset($tareas) && is_array($tareas) ? $tareas : [];

// Ordenar solo si hay tareas
if (!empty($tareas)) {
    if ($criterioOrden === 'prioridad') {
        usort($tareas, 'ordenarPorPrioridad');
    } else {
        usort($tareas, 'ordenarPorFecha');
    }
}
?>
>

<<body>
    <div class="container mt-4">
        <h2>Historial</h2>

        <a class="btn btn-outline-primary mb-3" href="?orden=fecha">Ordenar por Fecha</a>
        <a class="btn btn-outline-secondary mb-3" href="?orden=prioridad">Ordenar por Prioridad</a>

        <ul class="list-group">
            <?php if (!empty($tareas)): ?>
                <?php foreach ($tareas as $tarea): ?>
                    <?php if ($tarea['archivo'] === '2' || $tarea['archivo'] === '3'): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center <?= obtenerColorEstado($tarea['prioridad']) ?>"
                            onclick="redirigirTarea('<?= $tarea['id'] ?>')">
                            <div>
                                <strong><?= esc($tarea['tema']) ?></strong> - Fecha de vencimiento: <?= esc($tarea['fecha_vencimiento']) ?>
                            </div>
                            <span>Estado: <?= obtenerNombreEstado($tarea['estado']) ?></span>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="list-group-item">No hay tareas.</li>
            <?php endif; ?>
        </ul>
    </div>

    <script>
        function redirigirTarea(idTarea) {
            window.location.href = "<?= site_url('detalles_historial') ?>/" + idTarea;
        }
    </script>
</body>
