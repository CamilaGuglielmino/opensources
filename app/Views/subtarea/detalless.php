
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
   <div class="d-flex flex-wrap gap-2 my-3">
  <button onclick="editarTarea()" class="btn btn-purple">Editar</button>
  <button onclick="finalizarTarea()" class="btn btn-purple">Completada</button>
  <button onclick="eliminarTarea()" class="btn btn-purple">Eliminar</button>
<a href="<?= site_url('tareas/formulario/' . $tarea['id']) ?>" class="btn btn-purple">Compartir</a>

  <a href="<?= site_url('subtareas/crear/') . $tarea['id'] ?>"class="btn btn-purple">Agregar una Subtarea</a>
</div>
    <h3>Subtareas</h3>
    <?php if (!empty($subtareas)): ?>
        <ul>
            <?php foreach ($subtareas as $subtarea): ?>
                <li>
                    <strong><?= $subtarea['descripcion'] ?></strong> - Estado: <?= $subtarea['estado'] ?>
                </li>
                   <div class="d-flex flex-wrap gap-2 my-3">
                    <button onclick="editarSubtarea()" class="btn btn-purple">Editar</button>
                    <button onclick="eliminarSubtarea()" class="btn btn-purple">Eliminar</button>
                     <a href="<?= site_url('subtarea/formulario/' . $subtarea['id']) ?>" class="btn btn-purple">Compartir</a>
                    </div>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No hay subtareas asociadas a esta tarea.</p>
    <?php endif; ?>
   <div class="d-flex flex-wrap gap-2 my-3">
    <a href="<?= site_url('tareas') ?>" class="btn btn-purple">Volver</a>
  </div>
 
</div>
</body>
<script>
//TAREA
function editarTarea() {
 window.location.href = '<?= site_url('tareas/editar/') ?>' + <?= $tarea['id'] ?>;
}

function finalizarTarea() {
    fetch('<?= site_url('tareas/finalizar/') ?>' + <?= $tarea['id'] ?>, {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        alert('Tarea completada');
        window.location.href = '<?= site_url('tareas') ?>';
    })
    .catch(error => console.error('Error:', error));
}

function eliminarTarea() {
    if (confirm('¿Estás seguro de que quieres eliminar esta tarea?')) {
        fetch('<?= site_url('tareas/eliminar/') ?>' + <?= $tarea['id'] ?>, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            alert('Tarea eliminada');
            window.location.href = '<?= site_url('tareas') ?>';
        })
        .catch(error => console.error('Error:', error));
    }
}


//SUBTAREA
function editarSubtarea() {
    window.location.href = '<?= site_url('subtarea/editar/') ?>' + <?= $subtarea['id'] ?>;
}

function finalizarSubtarea() {
    fetch('<?= site_url('tareas/finalizar/') ?>' + <?= $subtarea['id'] ?>, {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        alert('Tarea completada');
        window.location.href = '<?= site_url('subtarea') ?>';
    })
    .catch(error => console.error('Error:', error));
}

function eliminarSubtarea() {
    if (confirm('¿Estás seguro de que quieres eliminar esta tarea?')) {
        fetch('<?= site_url('tareas/eliminar/') ?>' + <?= $subtarea['id'] ?>, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            alert('Tarea eliminada');
            window.location.href = '<?= site_url('subtarea') ?>';
        })
        .catch(error => console.error('Error:', error));
    }
}

</script>