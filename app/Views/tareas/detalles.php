
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
  <a href="<?= site_url('tareas/finalizar/' . $tarea['id']) ?>" class="btn btn-purple">Completar</a>
  <a href="<?= site_url('tareas/eliminar/' . $tarea['id']) ?>" class="btn btn-purple">Eliminar</a>
    <a href="<?= site_url('tareas/formulario/' . $tarea['id']) ?>" class="btn btn-purple">Compartir</a>

  <a href="<?= site_url('subtareas/crear/') . $tarea['id'] ?>"class="btn btn-purple">Agregar una Subtarea</a>
</div>
   <h3>Subtareas</h3>
<?php if (!empty($subtareas)): ?>
    <ul>
        <?php foreach ($subtareas as $subtarea): ?>
    <li>
        
        <strong>Descripción:</strong> <?= esc($subtarea['descripcion']) ?><br>
        <strong>Prioridad:</strong> <?= esc($subtarea['nombre_prioridad']) ?><br>
        <?php if (!empty($subtarea['colaborador'])): ?>
            <strong>Colaborador:</strong> <?= esc($subtarea['colaborador']) ?><br>
        <?php endif; ?>
        
        <strong>Estado:</strong> <?= esc($subtarea['nombre_estado']) ?>
        
        <div class="d-flex flex-wrap gap-2 my-3">
            <a href="<?= site_url('subtareas/editar/' . $subtarea['id']) ?>" class="btn btn-purple">Editar</a>
            <a href="<?= site_url('subtareas/eliminar/' . $subtarea['id']) ?>" class="btn btn-purple" 
               onclick="return confirm('¿Estás seguro de eliminar esta subtarea?');">Eliminar</a>
            <a href="<?= site_url('subtarea/formulario/' . $subtarea['id']) ?>" class="btn btn-purple">Compartir</a>
        </div>
    </li>
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




//SUBTAREA

function editarSubtarea(id) {
    window.location.href = '<?= site_url('subtareas/editar/') ?>' + id;
}

function eliminarSubtarea(id) {
    if (confirm('¿Estás seguro de que quieres eliminar esta subtarea?')) {
        fetch('<?= site_url('subtareas/eliminar/') ?>' + id, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            alert('Subtarea eliminada');
            window.location.reload(); // Recarga la página para ver cambios
        })
        .catch(error => console.error('Error:', error));
    }
}

function finalizarSubtarea(id) {
    fetch('<?= site_url('subtareas/finalizar/') ?>' + id, {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        alert('Subtarea completada');
        window.location.href = '<?= site_url('tareas') ?>';
    })
    .catch(error => console.error('Error:', error));
}





</script>