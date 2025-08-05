<?php include '../include/header.php'; ?>

<div class="container mt-4">
  <h2>Editar Institución</h2>
  <form method="POST" action="index.php?action=editarInstitucion" class="row g-3">

    <input type="hidden" name="id" value="<?= $institucion['id_institucion'] ?>">
    <input type="hidden" name="id_localizacion" value="<?= $institucion['id_localizacion'] ?>">

    <div class="col-md-6">
      <label class="form-label">Nombre:</label>
      <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($institucion['nombre']) ?>" required>
    </div>

    <div class="col-md-6">
      <label class="form-label">Código de entidad:</label>
      <input type="number" name="codigo_entidad" class="form-control" value="<?= $institucion['codigo_entidad'] ?>" required>
    </div>

    <h4 class="mt-4">Dirección</h4>

    <div class="col-md-6">
      <label class="form-label">Calle:</label>
      <input type="text" name="calle" class="form-control" value="<?= $institucion['calle'] ?>">
    </div>

    <div class="col-md-2">
      <label class="form-label">Número:</label>
      <input type="text" name="numero" class="form-control" value="<?= $institucion['numero'] ?>">
    </div>

    <div class="col-md-4">
      <label class="form-label">Código postal:</label>
      <input type="text" name="cod_postal" class="form-control" value="<?= $institucion['cod_postal'] ?>">
    </div>

    <div class="col-md-6">
      <label class="form-label">Departamento:</label>
      <input type="text" name="departamento" class="form-control" value="<?= $institucion['departamento'] ?>">
    </div>

    <div class="col-md-6">
      <label class="form-label">Piso:</label>
      <input type="text" name="piso" class="form-control" value="<?= $institucion['piso'] ?>">
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn-success">Guardar cambios</button>
    </div>
  </form>
</div>

<?php include '../include/footer.php'; ?>
