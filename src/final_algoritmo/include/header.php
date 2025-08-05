<?php
// Inicia sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Incluir modelo para obtener nombre institución
require_once __DIR__ . '/../model/InstitucionModel.php';

$nombreInstitucionActiva = null;
if (isset($_SESSION['id_institucion'])) {
    $nombreInstitucionActiva = InstitucionModel::obtenerNombreInstitucion($_SESSION['id_institucion']);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Mi Sistema</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- (Opcional) FontAwesome para iconos -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Mi Sistema</a>

    <div class="d-flex align-items-center">
      <?php if ($nombreInstitucionActiva): ?>
        <span class="text-white me-3">
          <i class="fas fa-building"></i> Institución activa: <strong><?= htmlspecialchars($nombreInstitucionActiva) ?></strong>
        </span>
      <?php endif; ?>

      <?php if (isset($_SESSION['user_id'])): ?>
        <form method="POST" action="index.php?action=logout" class="m-0">
          <button type="submit" class="btn btn-outline-light btn-sm">
            <i class="fas fa-sign-out-alt"></i> Cerrar sesión
          </button>
        </form>
      <?php else: ?>
        <a href="index.php?action=login" class="btn btn-outline-light btn-sm">Iniciar sesión</a>
      <?php endif; ?>
    </div>
  </div>
</nav>

<div class="container mt-4">

<!-- Bootstrap Bundle JS (con Popper incluido) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
