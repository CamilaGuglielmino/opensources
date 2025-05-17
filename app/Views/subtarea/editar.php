<!-- ALERTA DE MENSAJES -->
<?php if (session()->getFlashdata('mensajeError')): ?>
  <div class="alert alert-danger"><?= session()->getFlashdata('mensajeError') ?></div>
<?php endif; 
if (session()->getFlashdata('mensaje')): ?>
  <div class="alert alert-success"><?= session()->getFlashdata('mensaje') ?></div>
<?php endif; 
if (session()->getFlashdata('error')): ?>
  <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div class="container">
    <h2>Editar Subtarea</h2>

    <form action="<?= base_url('subtareas/guardar') ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= $subtarea['id'] ?>">

        <input type="hidden" name="usuario" value="<?= session()->get('usuario')['id'] ?>">

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion" class="form-control" value="<?= esc($subtarea['descripcion']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado:</label>
            <select id="estado" name="estado" class="form-control" required>
                <option value="2" <?= ($subtarea['estado'] == 2) ? 'selected' : '' ?>>En proceso</option>
                <option value="3" <?= ($subtarea['estado'] == 3) ? 'selected' : '' ?>>Completada</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="prioridad" class="form-label">Prioridad:</label>
            <select id="prioridad" name="prioridad" class="form-control">
                <option value="baja" <?= ($subtarea['prioridad'] == 'baja') ? 'selected' : '' ?>>Baja</option>
                <option value="normal" <?= ($subtarea['prioridad'] == 'normal') ? 'selected' : '' ?>>Normal</option>
                <option value="alta" <?= ($subtarea['prioridad'] == 'alta') ? 'selected' : '' ?>>Alta</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="vencimiento" class="form-label">Fecha de Vencimiento:</label>
            <input type="date" id="vencimiento" name="vencimiento" class="form-control" value="<?= esc($subtarea['fecha_vencimiento']) ?>">
        </div>

        <div class="mb-3">
            <label for="comentario" class="form-label">Comentario:</label>
            <textarea id="comentario" name="comentario" class="form-control" required><?= esc($subtarea['comentario']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="<?= site_url('tareas') ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
