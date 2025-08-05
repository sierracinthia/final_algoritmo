<?php include '../include/header.php'; ?>

<div class="container mt-4">

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Listado de Instituciones</h2>
    <a href="index.php?action=dashboard" class="btn btn-outline-primary">
      ← Volver al panel principal
    </a>
  </div>

  <a href="index.php?action=mostrarFormularioCrearInstitucion" class="btn btn-primary mb-3">Crear nueva institución</a>

  <?php if (empty($instituciones)): ?>
    <div class="alert alert-info">No tenés instituciones asociadas aún.</div>
  <?php else: ?>
    <ul class="list-group">
      <?php foreach ($instituciones as $institucion): ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <div>
            <strong><?= htmlspecialchars($institucion['nombre']) ?></strong> - 
            Código de entidad: <?= htmlspecialchars($institucion['codigo_entidad']) ?> - 
            Dirección: <?= htmlspecialchars($institucion['calle']) ?> <?= htmlspecialchars($institucion['numero']) ?> - 
            Estado: <?= $institucion['estado'] == 1 
              ? '<span class="badge bg-success">Activo</span>' 
              : '<span class="badge bg-secondary">Inactivo</span>' ?>
          </div>
          <div>
            <a href="index.php?action=editarInstitucion&id=<?= $institucion['id_institucion'] ?>" class="btn btn-sm btn-warning me-2">Editar</a>

            <?php if ($institucion['estado'] == 1): ?>
              <a href="index.php?action=desactivarInstitucion&id=<?= $institucion['id_institucion'] ?>&estado=0" class="btn btn-sm btn-outline-danger">Desactivar</a>
            <?php else: ?>
              <a href="index.php?action=desactivarInstitucion&id=<?= $institucion['id_institucion'] ?>&estado=1" class="btn btn-sm btn-outline-success">Activar</a>
            <?php endif; ?>

            <a href="index.php?action=entrarInstitucion&id=<?= $institucion['id_institucion'] ?>" class="btn btn-primary btn-sm">Entrar</a>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

</div>

<?php include '../include/footer.php'; ?>
