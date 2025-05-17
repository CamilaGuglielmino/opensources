<body>
    <div class="container mt-5">
        
        <?php if (session()->getFlashdata('mensajeError')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('mensajeError') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('mensaje')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('mensaje') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

       
        <div class="d-flex justify-content-end">
            <a href="<?= base_url('/') ?>" class="btn-close" aria-label="Cerrar"></a>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-10">
                <form action="<?= base_url('login') ?>" method="POST" class="form-container">
                    <?= csrf_field() ?>

                    <h2 class="mb-4 text-center">Iniciar sesión</h2>

                    <div class="mb-3">
                        <label for="usuario" class="form-label">E-mail:</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="contra" class="form-label">Contraseña:</label>
                        <input type="password" name="contra" id="contra" class="form-control" required>
                    </div>

                    <div class="d-grid">
                        <input type="submit" name="ingresar" value="Iniciar sesión" class="btn btn-primary-custom">
                    </div>
                </form>
            </div>
        </div>
    </div>


</body>