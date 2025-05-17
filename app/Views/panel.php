<body>
    <?php
    function obtenerColorEstado($prioridad)
    {
        switch ($prioridad) {
            case 1:
                return 'bg-danger'; // Rojo para tareas críticas
            case 2:
                return 'bg-warning'; // Amarillo para tareas importantes
            case 3:
                return 'bg-success'; // Verde para tareas completadas
            default:
                return 'bg-secondary'; // Gris para estados desconocidos
        }

    }
    function obtenerNombreEstado($estado)
    {
        switch ($estado) {
            case 1:
                return 'Definido';
            case 2:
                return 'En proceso';
            case 3:
                return 'Completada';
            default:
                return 'Desconocido';
        }
    }
    function obtenerNombrePrioridad($prioridad1)
    {
        switch ($prioridad1) {
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

    // Función para ordenar por prioridad
    function ordenarPorPrioridad($a, $b)
    {
        return $a['prioridad'] - $b['prioridad'];
    }

    // Función para ordenar por fecha de vencimiento
    function ordenarPorFecha($a, $b)
    {
        return strtotime($a['fecha_vencimiento']) - strtotime($b['fecha_vencimiento']);
    }

    // Definir el criterio de orden (puedes cambiar entre 'fecha' y 'prioridad')
    $criterioOrden = $_GET['orden'] ?? 'fecha';


    $tareas = isset($tareas) && is_array($tareas) ? $tareas : [];

    // Aplicar ordenamiento según el criterio SOLO si hay elementos
    if (!empty($tareas)) {
        if ($criterioOrden === 'prioridad') {
            usort($tareas, 'ordenarPorPrioridad');
        } else {
            usort($tareas, 'ordenarPorFecha');
        }
    } else { ?>
        <li class="list-group-item">No hay tareas.</li>
    <?php } 
    $usuario = session()->get('usuario');
$usuario_id = $usuario['id'] ?? null;
$usuario_correo = strtolower(trim($usuario['correo'] ?? ''));

$tarea_colaboradores = array_map('trim', explode(',', strtolower($tarea['colaborador'] ?? '')));

?>

    <div class="container mt-4">
        <h2>Panel tareas - subtareas </h2>

        <!-- Botones para cambiar el orden -->
        <a class="btn btn-outline-secondary mb-3" href="<?php echo base_url('/crear') ?>">Nueva Tarea</a>
        <a class="btn btn-outline-primary mb-3" href="?orden=fecha">Ordenar por Fecha</a>
        <a class="btn btn-outline-primary mb-3" href="?orden=prioridad">Ordenar por Prioridad</a>

       <ul class="list-group">
    <?php foreach ($tareas as $tarea):
        if($tarea['archivo']==='1'): ?>
        <li class="list-group-item d-flex justify-content-between align-items-center <?= obtenerColorEstado($tarea['prioridad']) ?>"
            onclick="redirigirTarea('<?= $tarea['id'] ?>')">
            <div>
                <strong><?= $tarea['tema'] ?></strong> - Fecha de vencimiento: <?= $tarea['fecha_vencimiento'] ?>
            </div>
            <span>Estado: <?= obtenerNombreEstado($tarea['estado']) ?></span>
        </li>
    <?php endif; endforeach; ?>
</ul>


    </div>
    <script>
    function redirigirTarea(idTarea) {
    window.location.href = "<?= base_url('detalles') ?>/" + idTarea;
}
    </script>
</body>