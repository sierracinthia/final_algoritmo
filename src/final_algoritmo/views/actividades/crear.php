<?php include '../include/header.php'; ?>
<div class="container mt-4">
    <h2 class="mb-4">Crear Nueva Actividad</h2>

    <!-- Botón para volver al listado de actividades -->
    <a href="index.php?action=verActividades" class="btn btn-secondary mb-3">
        ← Volver al listado de actividades
    </a>

    <form action="index.php?action=guardarActividad" method="POST">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Actividad</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="4"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Actividad</button>
    </form>
        <a href="index.php?action=institucionDashboard" class="btn btn-outline-secondary">
      ← Volver al panel de la institución
    </a>
</div>
