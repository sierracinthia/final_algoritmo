<!-- views/home.php -->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Bienvenido - Mi Sistema</title>
  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

  <div class="container vh-100 d-flex flex-column justify-content-center align-items-center">
    <h1 class="mb-4 fw-bold text-primary">Bienvenido a Mi Sistema</h1>
    <p class="mb-5 text-secondary text-center">Gestiona tus instituciones y usuarios fácilmente</p>

    <div class="d-flex gap-3">
      <a href="index.php?action=login" class="btn btn-primary btn-lg px-4">Iniciar sesión</a>
      <a href="index.php?action=register" class="btn btn-outline-primary btn-lg px-4">Registrarte</a>
    </div>
  </div>

  <!-- Bootstrap JS Bundle CDN (Popper + Bootstrap) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
