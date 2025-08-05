<?php include '../include/header.php'; ?>

<div class="container mt-4">
  <h2>Crear Institución</h2>
  <form method="POST" action="index.php?action=crearInstitucion" class="row g-3">

    <div class="col-md-6">
      <label class="form-label">Nombre:</label>
      <input type="text" name="nombre" class="form-control" required>
    </div>

    <div class="col-md-6">
      <label class="form-label">Código de entidad:</label>
      <input type="number" name="codigo_entidad" class="form-control" required>
    </div>

    <h4 class="mt-4">Localización</h4>

    <div class="col-md-6">
      <label class="form-label">Calle:</label>
      <input type="text" name="calle" class="form-control">
    </div>

    <div class="col-md-2">
      <label class="form-label">Número:</label>
      <input type="number" name="numero" class="form-control">
    </div>

    <div class="col-md-4">
      <label class="form-label">Código postal:</label>
      <input type="text" name="cod_postal" class="form-control">
    </div>

    <div class="col-md-6">
      <label class="form-label">Departamento:</label>
      <input type="number" name="departamento" class="form-control">
    </div>

    <div class="col-md-6">
      <label class="form-label">Piso:</label>
      <input type="number" name="piso" class="form-control">
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn-primary">Crear Institución</button>
    </div>
  </form>
    <!-- Botón para ver listado de instituciones -->
  <div class="mb-3">
    <a href="index.php?action=listarInstituciones" class="btn btn-secondary">
      Listar instituciones
    </a>
  </div>
  <div class="container mt-4">
  <a href="index.php?action=institucionDashboard" class="btn btn-outline-secondary mb-3">
    ← Volver al panel de la institución
  </a>
</div>

<?php include '../include/footer.php'; ?>
