<?php include '../include/header.php'; ?>

<div class="container mt-4">
    <h2>Confirmar eliminación de cuenta</h2>
    <p>¿Estás seguro de que querés eliminar tu cuenta? Esta acción no se puede deshacer.</p>

    <form method="POST" action="index.php?action=eliminarCuenta">
        <input type="hidden" name="confirmar" value="SI">
        <button type="submit" class="btn btn-danger">Sí, eliminar mi cuenta</button>
        <a href="index.php?action=perfilUsuario" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include '../include/footer.php'; ?>
