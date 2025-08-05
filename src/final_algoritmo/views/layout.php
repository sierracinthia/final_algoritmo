<!-- app/views/layout.php -->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?? 'Sistema de gestión' ?></title>
</head>
<body>
  <div class="container">
    <?= $content ?>
  </div>
</body>
</html>
