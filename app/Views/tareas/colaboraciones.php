<h2>Tareas donde colaborás: <?= esc($usuario_correo) ?></h2>

<ul class="list-group">
    <?php if (!empty($tareas)): ?>
        <?php foreach ($tareas as $tarea): ?>
            <li class="list-group-item">
                <strong><?= esc($tarea['tema']) ?></strong> - <?= esc($tarea['descripcion']) ?>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li class="list-group-item">No estás asignado como colaborador en ninguna tarea.</li>
    <?php endif; ?>
</ul>
