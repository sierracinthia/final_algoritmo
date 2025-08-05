<?php include '../include/header.php';
if (!isset($institucion)) {
    die('No se ha definido la variable $institucion');
}
?>
<div class="container mt-5">
  <h2 class="mb-4">Panel de gestión de institución</h2>

  <div class="card">
    <div class="card-body">
      <p><strong>Institución actual:</strong> <?= htmlspecialchars($institucion['nombre'] ?? 'Nombre no disponible') ?></p>

      <div class="d-grid gap-2 d-md-block">
        <a href="index.php?action=verActividades" class="btn btn-primary mb-2">Ver actividades</a>
        <a href="index.php?action=crearActividad" class="btn btn-success mb-2">Crear nueva actividad</a>
        <a href="" class="btn btn-info mb-2">Ver cronogramas</a>
        <a href="index.php?action=salirInstitucion" class="btn btn-secondary mb-2">Salir de esta institución</a>
      </div>
    </div>
  </div>
</div>

<?php include '../include/footer.php'; ?>
