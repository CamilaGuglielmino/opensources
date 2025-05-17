<body>
    <div class="container mt-4">
        <!-- MENSAJES FLASH -->
        <?php if (session()->getFlashdata('mensajeError')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('mensajeError') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('mensaje')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('mensaje') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <!-- NOTIFICACIONES TAREA | SUBTAREA -->
        <?php if (session()->has('usuario')): ?>
            <?php
            $VencenEn3Dias = false;
            $recordatorioHoy = false;
            $fechaHoy = strtotime(date('Y-m-d'));
            $tareas = session()->get('tareas') ?? [];
            $subtareas = session()->get('subtareas') ?? [];

            // Validar tareas pendientes
            if (!empty($tareas)) {
                foreach ($tareas as $t):
                    $fechaVencimiento = strtotime($t['fecha_vencimiento']);
                    $diasRestantes = ($fechaVencimiento - $fechaHoy) / (60 * 60 * 24);

                    if ($diasRestantes <= 3 && $diasRestantes >= 0) {
                        $VencenEn3Dias = true;
                    }

                    if (!empty($t['fecha_recordatorio']) && strtotime($t['fecha_recordatorio']) === $fechaHoy) {
                        $recordatorioHoy = true;
                    }
                endforeach;
            }

            // Validar subtareas pendientes
            $VencenEn3DiasSubtarea = false;
            if (!empty($subtareas)) {
                foreach ($subtareas as $s):
                    $fechaVencimiento = strtotime($s['fecha_vencimiento']);
                    $diasRestantes = ($fechaVencimiento - $fechaHoy) / (60 * 60 * 24);

                    if ($diasRestantes <= 3 && $diasRestantes >= 0) {
                        $VencenEn3DiasSubtarea = true;
                    }
                endforeach;
            }
            ?>

            <div class="container mt-4">
                <?php if ($VencenEn3Dias): ?>
                    <div class="alert alert-danger mt-3 text-center">
                        ⚠️ <strong>Alerta:</strong> Tienes una tarea que vence en menos de 3 días. ¡Revisala!
                    </div>
                <?php endif; ?>

                <?php if ($recordatorioHoy): ?>
                    <div class="alert alert-primary mt-3 text-center">
                        📌 <strong>Recordatorio:</strong> Tienes una tarea programada para hoy.
                    </div>
                <?php endif; ?>

                <?php if ($VencenEn3DiasSubtarea): ?>
                    <div class="alert alert-danger mt-3 text-center">
                        ⚠️ <strong>Alerta:</strong> Una subtarea vencerá en menos de 3 días. ¡No olvides revisarla!
                    </div>
                <?php endif; ?>

                <?php if (empty($tareas) && empty($subtareas)): ?>
                    <div class="alert alert-secondary mt-3 text-center">
                        🎉 No tienes tareas pendientes. ¡Buen trabajo!
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>


        <!-- SECCIÓN CENTRAL -->
        <section class="section-content">
            <h3>Potencia tu productividad con una gestión de tareas eficiente</h3>
            <p>Bienvenido a tu nueva herramienta de organización, diseñada para optimizar tu flujo de trabajo, ya sea de
                forma individual o en equipo.</p>
            <ul class="list-unstyled">
                <li>✔ <strong>Organización inteligente:</strong> Define prioridades, fechas de vencimiento y
                    recordatorios.</li>
                <li>✔ <strong>Gestión colaborativa:</strong> Comparte tareas con tu equipo de manera efectiva.</li>
                <li>✔ <strong>Interfaz intuitiva:</strong> Administra todo con rapidez y facilidad.</li>
                <li>✔ <strong>Seguimiento en tiempo real:</strong> Ajusta tu planificación sobre la marcha.</li>
            </ul>
        </section>
    </div>
</body><br><br><br><br>