<?php include '../include/header.php'; ?>
  <div class="mb-3">
    <a href="index.php?action=home" class="btn btn-secondary">&larr; Volver atrás</a>
  </div>
<div class="container mt-5" style="max-width: 400px;">
  <h2 class="mb-4 text-center">Iniciar Sesión</h2>

  <form method="POST" action="?action=doLogin">
    <div class="mb-3">
      <label for="email" class="form-label">Usuario (email):</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Clave:</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-primary">Iniciar sesión</button>
    </div>
  <div class="text-center">
      <a href="index.php?action=register">¿No tienes cuenta? Regístrate aquí</a>
    </div>
  </form>
</div>
<?php include '../include/footer.php'; ?>
