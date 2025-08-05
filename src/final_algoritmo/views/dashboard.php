<?php include '../include/header.php'; ?>

<!DOCTYPE html>

<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4">Bienvenido, <?= htmlspecialchars($userName) ?></h2>
    <p>Estás en el panel de usuario.</p>

    <div class="d-flex flex-column flex-sm-row gap-3 mb-4">
      <a href="index.php?action=listarInstituciones" class="btn btn-primary flex-fill text-center">Ver instituciones</a>
      <a href="index.php?action=mostrarFormularioCrearInstitucion" class="btn btn-success flex-fill text-center">Crear institución</a>
      <a href="index.php?action=perfilUsuario" class="btn btn-secondary">Configuración</a>
    </div>

    <a href="index.php?action=logout" class="btn btn-danger">Cerrar sesión</a>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>