<body>
  <!--ALERTA DE MENSAJES -->
  <?php if (session()->getFlashdata('mensajeError')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('mensajeError') ?></div>
  <?php endif;
  if (session()->getFlashdata('mensaje')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('mensaje') ?></div>
  <?php endif;
  if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
  <?php endif; ?>

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

    <h4 class="text-start mb-4">Datos de la Subtarea</h4>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="<?= base_url('subtareas/create'); ?>" method="POST" autocomplete="off"
                class="p-4 bg-white shadow rounded">
                <?= csrf_field() ?>
                <input type="hidden" name="tarea_id" value="<?= $tarea['id'] ?>">

                <div class="mb-3">
                    <label class="form-label"><span class="text-danger">*</span> Descripción</label>
                    <input type="text" name="descripcion" class="form-control" required>
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
                    <label class="form-label"><label class="form-label"><span class="text-danger">*</span> Prioridad</label>
                    <select name="prioridad" class="form-select">
                        <option value="3">Baja</option>
                        <option value="2">Normal</option>
                        <option value="1">Alta</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fecha de vencimiento</label>
                    <input type="date" name="vencimiento" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label"><label class="form-label"><span class="text-danger">*</span> Comentario</label>
                    <textarea name="comentario" class="form-control" required> </textarea>
                </div>
                
                <input type="hidden" name="usuario" value="<?= session()->get('usuario')['id']; ?>">
                <div class="d-grid">
                    <button type="submit" name="subtarea" class="btn text-white" style="background-color:rgb(80, 38, 91);">
                        CREAR SUBTAREA
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>