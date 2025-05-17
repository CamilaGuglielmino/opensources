<div class="container mt-4 mb-5">
    <!-- MENSAJES DE ERROR -->
    <?php if (session()->get('errors')): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->get('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- BOTÓN DE CIERRE -->
    <div class="d-flex justify-content-end">
        <a href="<?= base_url('/') ?>" class="btn-close" aria-label="Cerrar"></a>
    </div>


    <h4 class="text-center">Datos de registro</h4>

    <div class="row justify-content-center mt-3">
        <div class="col-md-6">
            <form action="<?= base_url('registrar'); ?>" method="POST" enctype="multipart/form-data" autocomplete="off" class="form-container">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="<?= old('nombre') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Apellido</label>
                    <input type="text" name="apellido" class="form-control" value="<?= old('apellido') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="contra" class="form-control" required>
                </div>

                <div class="d-grid">
                    <input type="submit" name="registro" value="Registrarse" class="btn btn-primary-custom">
                </div>
            </form>
        </div>
    </div>
</div>