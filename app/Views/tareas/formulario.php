<
<?= csrf_field() ?>

<div class="container mt-4">
    <h2>Compartir tarea: <?= esc($tarea['tema']) ?></h2>

    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <form action="<?= site_url('tareas/compartirYEnviar/' . $tarea['id']) ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="correos" class="form-label">Ingresar correos electrónicos (separados por coma)</label>
            <input type="text" class="form-control" id="correos" name="correos" placeholder="correo1@example.com, correo2@example.com" required>
            <div class="form-text">Los colaboradores recibirán un correo para colaborar en la tarea.</div>
        </div>

        <button type="submit" class="btn btn-primary">Compartir y enviar correo</button>
        <a href="<?= site_url('tareas') ?>" class="btn btn-secondary">Volver</a>
    </form>
</div>
