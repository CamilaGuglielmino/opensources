<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Open Source</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= base_url('/openSource/public/img/logo.png') ?>">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgb(80, 38, 91);">
            <div class="container">
                <a href="<?= base_url('/'); ?>">
                    <img src="<?= base_url('imagenes/logo.png') ?>" alt="Logo" class="logo" width="80">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
                    aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navMenu">
                    <ul class="navbar-nav">
                        <?php if (session()->has('usuario')): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown"> Panel</a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="<?= base_url('/tareas') ?>">Lista de Tareas</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url('/crear') ?>">Crear Tarea</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url('colaborador') ?>">Colaboraciones</a></li>

                                    
                                </ul>
                            </li>


                            <li class="nav-item"><a class="nav-link text-white" href="<?= base_url('/historial'); ?>">Historial</a></li>
                            <li class="nav-item"><a class="nav-link text-danger" href="<?= base_url('/salir'); ?>">Cerrar sesión</a></li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link text-success" href="<?= base_url('/registro'); ?>">Registrarse</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('/login'); ?>">Iniciar sesión</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body><br><br><br>

</html>