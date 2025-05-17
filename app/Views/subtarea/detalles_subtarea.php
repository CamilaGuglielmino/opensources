
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
    <h2>Detalles de la subtarea</h2>
    <p><strong>Descripción:</strong> <?= $subtarea['descripcion'] ?></p>
    <p><strong>Fecha de creación:</strong> <?= $subtarea['fecha_creacion'] ?></p>
    <p><strong>Fecha de vencimiento:</strong> <?= $subtarea['fecha_vencimiento'] ?></p>
    <p><strong>Estado:</strong> <?= $subtarea['nombre_estado'] ?></p>
    <p><strong>Prioridad:</strong> <?= $subtarea['nombre_prioridad'] ?></p>
 
<div class="d-flex flex-wrap gap-2 my-3">
                    <button onclick="editarSubtarea()" class="btn btn-purple">Editar</button>
                    <button onclick="eliminarSubtarea()" class="btn btn-purple">Eliminar</button>
                     <a href="<?= site_url('subtarea/formulario/' . $subtarea['id']) ?>" class="btn btn-purple">Compartir</a>
                    </div>
   <div class="d-flex flex-wrap gap-2 my-3">
    <a href="<?= site_url('/') ?>" class="btn btn-purple">Volver</a>
  </div>
 
</div>
</body>
<script>

//SUBTAREA
//SUBTAREA
function editarSubtarea() {
    window.location.href = '<?= site_url('subtareas/editar/') ?>' + <?= $subtarea['id'] ?>;
}

function finalizarSubtarea() {
    fetch('<?= site_url('subtareas/finalizar/') ?>' + <?= $subtarea['id'] ?>, {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        alert('subtarea completada');
        window.location.href = '<?= site_url('subtareas') ?>';
    })
    .catch(error => console.error('Error:', error));
}

function eliminarSubtarea() {
    if (confirm('¿Estás seguro de que quieres eliminar esta subtarea?')) {
        fetch('<?= site_url('subtareas/eliminar/') ?>' + <?= $subtarea['id'] ?>, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            alert('Subtarea eliminada');
            window.location.href = '<?= site_url('tareas') ?>';
        })
        .catch(error => console.error('Error:', error));
    }
}

</script>