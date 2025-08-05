<?php include '../include/header.php'; ?>

<div class="container mt-4">
    <h2>Configuración de perfil</h2>

    <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'actualizado'): ?>
        <div class="alert alert-success">Perfil actualizado correctamente.</div>
    <?php endif; ?>

    <form method="POST" action="index.php?action=actualizarPerfil">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Apellido</label>
            <input type="text" name="apellido" id="apellido" value="<?= htmlspecialchars($usuario['apellido']) ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" name="email" id="email" value="<?= htmlspecialchars($usuario['email']) ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Cambiar contraseña (opcional)</label>
            <input type="password" name="password" id="contraseña" class="form-control" placeholder="Nueva contraseña">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar perfil</button>
    </form>

    <hr>

    <a href="index.php?action=eliminarCuenta" class="btn btn-danger mt-3">Eliminar cuenta</a>
</div>

<?php include '../include/footer.php'; ?>
