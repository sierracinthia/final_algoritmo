<?php include '../include/header.php'; ?>

<?php if (isset($_GET['msg']) && $_GET['msg'] === 'cuenta_eliminada'): ?>
    <div class="alert alert-success">
        Tu cuenta fue eliminada correctamente.
    </div>
<?php endif; ?>

  <div class="mb-3">
    <a href="index.php?action=home" class="btn btn-secondary">&larr; Volver atrás</a>
  </div>
<div class="container mt-5" style="max-width: 600px;">
  <h2 class="mb-4 text-center">Registro de Usuario</h2>
  
  <form method="POST" action="index.php?action=doRegister" class="row g-3">

    <div class="col-md-6">
      <label class="form-label">Nombre:</label>
      <input type="text" name="nombre" class="form-control" required>
    </div>

    <div class="col-md-6">
      <label class="form-label">Apellido:</label>
      <input type="text" name="apellido" class="form-control" required>
    </div>

    <div class="col-md-6">
      <label class="form-label">DNI:</label>
      <input type="text" name="dni" class="form-control" required>
    </div>

    <div class="col-md-6">
      <label class="form-label">Fecha de nacimiento:</label>
      <input type="date" name="fecha_nacimiento" class="form-control" required>
    </div>

    <div class="col-md-12">
      <label class="form-label">Email:</label>
      <input type="email" name="email" class="form-control" required>
    </div>

    <div class="col-md-12">
      <label class="form-label">Contraseña:</label>
      <input type="password" name="password" class="form-control" required>
    </div>

    <div class="col-12 text-center">
      <button type="submit" class="btn btn-success">Registrar</button>
    </div>
  </form>
</div>

<?php include '../include/footer.php'; ?>
