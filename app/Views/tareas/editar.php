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
<div class="container">
    <h2>Editar Tarea</h2>
    
    <form action="<?= base_url('guardar'); ?>" method="post">
         <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= $tarea['id'] ?>">
        <div class="mb-3">
            <label for="tema" class="form-label">Tema:</label>
            <input type="text" id="tema" name="tema" class="form-control" value="<?= $tarea['tema'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea id="descripcion" name="descripcion" class="form-control" required><?= $tarea['descripcion'] ?></textarea>
        </div>

        <div class="mb-3">
            <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento:</label>
            <input type="date" id="fecha_vencimiento" name="fecha_vencimiento" class="form-control" value="<?= $tarea['fecha_vencimiento'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado:</label>
            <select id="estado" name="estado" class="form-control">
                <option value="1" <?= ($tarea['estado'] == 1) ? 'selected' : '' ?>>Pendiente</option>
                <option value="2" <?= ($tarea['estado'] == 2) ? 'selected' : '' ?>>En progreso</option>
                <option value="3" <?= ($tarea['estado'] == 3) ? 'selected' : '' ?>>Completado</option>
                <option value="4" <?= ($tarea['estado'] == 4) ? 'selected' : '' ?>>Cancelado</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="prioridad" class="form-label">Prioridad:</label>
            <select id="prioridad" name="prioridad" class="form-control">
                <option value="1" <?= ($tarea['prioridad'] == 1) ? 'selected' : '' ?>>Alta</option>
                <option value="2" <?= ($tarea['prioridad'] == 2) ? 'selected' : '' ?>>Media</option>
                <option value="3" <?= ($tarea['prioridad'] == 3) ? 'selected' : '' ?>>Baja</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="<?= site_url('tareas') ?>" class="btn btn-secondary">Cancelar</a>

    </form>
</div>