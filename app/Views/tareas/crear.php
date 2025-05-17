<body>
  
<!--ALERTA DE MENSAJES -->
  <?php /*if (session()->getFlashdata('mensajeError')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('mensajeError') ?></div>
  <?php endif;
  if (session()->getFlashdata('mensaje')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('mensaje') ?></div>
  <?php endif;
  if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
  <?php endif; */ ?> 

  <div class="container mt-4 mb-5">
    <!-- Errores de validación -->
    <?php if (session()->get('errors')): ?>
      <div class="alert alert-danger">
        <ul class="mb-0">
          <?php foreach (session()->get('errors') as $error): ?>
            <li><?= esc($error) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <div class="alert alert-warning text-center" role="alert">
      <strong>Atención:</strong> Este panel es para crear una tarea.
    </div>
    <div class="d-flex justify-content-end">
      <a href="<?= base_url('/') ?>" class="btn-close" aria-label="Cerrar"></a>
    </div>

    <p class="text-start text-muted">
    <h4 class="text-start mb-4">Datos de la Tarea</h4>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form action="<?= base_url('tareas/create'); ?>" method="POST" enctype="multipart/form-data" autocomplete="off"
          class="p-4 bg-white shadow rounded">
          <?= csrf_field() ?>
          <div class="mb-3">
            <label class="form-label"><span class="text-danger">*</span> Tema</label>
            <input type="text" name="tema" class="form-control"  value="<?= old('tema') ?>"required>
          </div>

          <div class="mb-3">
            <label class="form-label"><span class="text-danger">*</span> Descripción</label>
            <input type="text" name="descripcion" class="form-control" value="<?= old('descripcion') ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label"><span class="text-danger">*</span> Prioridad</label>
            <select name="prioridad" class="form-select" required>
              <option value="3">Baja</option>
              <option value="2">Normal</option>
              <option value="1">Alta</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label"><span class="text-danger">*</span> Estado</label>
            <select name="estado" class="form-select" required>
              <option value="1">Definido</option>
              <option value="2">En proceso</option>
              <option value="3">Completada</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label"><span class="text-danger">*</span> Fecha de vencimiento</label>
            <input type="date" name="fecha_vencimiento" class="form-control"  required>
          </div>

          <div class="mb-3">
            <label class="form-label">Fecha de recordatorio</label>
            <input type="date" name="fecha_recordatorio" class="form-control" >
          </div>

         <input type="hidden" name="usuario" value="<?= session()->get('usuario')['id']; ?>">


          <div class="d-grid">
            <button type="submit" name="tarea" class="btn text-white" style="background-color:rgb(80, 38, 91);">CREAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>