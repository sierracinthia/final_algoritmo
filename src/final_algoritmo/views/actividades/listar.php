<?php include '../include/header.php'; ?>

<div class="container mt-4">

  <div class="mb-3">
        <a href="index.php?action=crearActividad" class="btn btn-primary">Crear nueva actividad</a>

    </div>
    <h2 class="mb-4">Listado de Actividades</h2>

    <?php if (!empty($actividades)): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($actividades as $actividad): ?>
                        <tr>
                            <td><?= htmlspecialchars($actividad['nombre']) ?></td>
                            <td><?= htmlspecialchars($actividad['descripcion']) ?></td>
                            <td>
                            <!-- Botón Modificar -->
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalEditar<?= $actividad['id_actividad'] ?>">
                                Modificar
                            </button>

                            <!-- Botón Eliminar -->
                            <a href="index.php?action=eliminarActividad&id=<?= $actividad['id_actividad'] ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('¿Estás seguro de eliminar esta actividad?')">
                                Eliminar
                            </a>
                        </td>
                        </tr>
                          <!-- Modal de edición -->
                    <div class="modal fade" id="modalEditar<?= $actividad['id_actividad'] ?>" tabindex="-1"
                         aria-labelledby="modalLabel<?= $actividad['id_actividad'] ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <form method="post" action="index.php?action=actualizarActividad">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel<?= $actividad['id_actividad'] ?>">
                                            Editar Actividad
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id_actividad" value="<?= $actividad['id_actividad'] ?>">
                                        <div class="mb-3">
                                            <label for="nombre<?= $actividad['id_actividad'] ?>" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" name="nombre"
                                                   value="<?= htmlspecialchars($actividad['nombre']) ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="descripcion<?= $actividad['id_actividad'] ?>" class="form-label">Descripción</label>
                                            <textarea class="form-control" name="descripcion" rows="3"
                                                      required><?= htmlspecialchars($actividad['descripcion']) ?></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info" role="alert">
            No hay actividades registradas.
        </div>
    <?php endif; ?>
    <a href="index.php?action=institucionDashboard" class="btn btn-outline-secondary">
      ← Volver al panel de la institución
    </a>
</div>
