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


    $subtareas = isset($subtareas) && is_array($subtareas) ? $subtareas : [];

    // Aplicar ordenamiento según el criterio SOLO si hay elementos
    if (!empty($subtareas)) {
        if ($criterioOrden === 'prioridad') {
            usort($subtareas, 'ordenarPorPrioridad');
        } else {
            usort($subtareas, 'ordenarPorFecha');
        }
    } else { ?>
        <li class="list-group-item">No hay subtareas.</li>
    <?php } 
    $usuario = session()->get('usuario');
$usuario_id = $usuario['id'] ?? null;
$usuario_correo = strtolower(trim($usuario['correo'] ?? ''));

$tarea_colaboradores = array_map('trim', explode(',', strtolower($tarea['colaborador'] ?? '')));

?>

    <div class="container mt-4">
        <h2>Panel subtareas </h2>

        <!-- Botones para cambiar el orden -->
        <a class="btn btn-outline-secondary mb-3" href="<?php echo base_url('/crear') ?>">Nueva Tarea</a>
        <a class="btn btn-outline-primary mb-3" href="?orden=fecha">Ordenar por Fecha</a>
        <a class="btn btn-outline-primary mb-3" href="?orden=prioridad">Ordenar por Prioridad</a>

       <ul class="list-group">
    <?php foreach ($subtareas as $subtarea):
       ?>
        <li class="list-group-item d-flex justify-content-between align-items-center <?= obtenerColorEstado($subtarea['prioridad']) ?>"
            onclick="redirigirSubtarea('<?= $subtarea['id'] ?>')">
            <div>
                <strong><?= $subtarea['descripcion'] ?></strong> - Fecha de vencimiento: <?=$subtarea['fecha_vencimiento'] ?>
            </div>
            <span>Estado: <?= obtenerNombreEstado($subtarea['estado']) ?></span>
        </li>
    <?php endforeach; ?>
</ul>


    </div>
  <script>
function redirigirSubtarea(idSubtarea) {
    window.location.href = "<?= site_url('detalles_subtarea') ?>/" + idSubtarea;
}
</script>

</body>