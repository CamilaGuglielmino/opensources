
<style>
  .btn-purple {
    background-color: rgb(80, 38, 91);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .btn-purple:hover {
    background-color: rgb(100, 50, 110);
  }
</style>
<body>


  <div class="container">
    <h2>Detalles de la Tarea</h2>
    <p><strong>Tema:</strong> <?= $tarea['tema'] ?></p>
    <p><strong>Descripción:</strong> <?= $tarea['descripcion'] ?></p>
    <p><strong>Fecha de creación:</strong> <?= $tarea['fecha_creacion'] ?></p>
    <p><strong>Fecha de vencimiento:</strong> <?= $tarea['fecha_vencimiento'] ?></p>
    <p><strong>Estado:</strong> <?= $tarea['nombre_estado'] ?></p>
    <p><strong>Prioridad:</strong> <?= $tarea['nombre_prioridad'] ?></p>

    <h3>Subtareas</h3>
    <?php if (!empty($subtareas)): ?>
        <ul>
            <?php foreach ($subtareas as $subtarea): ?>
                <li>
                    <strong><?= $subtarea['descripcion'] ?></strong> - Estado: <?= $subtarea['estado'] ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No hay subtareas asociadas a esta tarea.</p>
    <?php endif; ?>

    <div class="d-flex flex-wrap gap-2 my-3">
    <a href="<?= site_url('historial') ?>" class="btn btn-purple">Volver</a>
  <button onclick="editarTarea()" class="btn btn-purple">Editar</button>
</div>
</div>
</body>
<script>
  function editarTarea() {
    window.location.href = '<?= site_url('tareas/editar/') ?>' + <?= $tarea['id'] ?>;
}


</script>