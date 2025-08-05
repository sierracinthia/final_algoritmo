<?php
require_once __DIR__ . '/../model/InstitucionModel.php';
require_once __DIR__ . '/../model/PersonaModel.php';
require_once __DIR__ . '/../model/actividadModel.php';  // Ajusta la ruta según tu estructura
require_once __DIR__ . '/../config/database.php';  // para getPDO()


class actividadController {
    public function crearActividad($nombre, $descripcion, $idInstitucion) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO actividad (nombre, descripcion, id_institucion) VALUES (?, ?, ?)");
        return $stmt->execute([$nombre, $descripcion, $idInstitucion]);
    }

    public static function mostrarFormularioCrear() {
        require __DIR__ . '/../views/actividades/crear.php';
    }

    public static function guardarActividad() {
        if (!isset($_SESSION['id_institucion'])) {
            echo "No hay institución activa.";
            return;
        }

        $datos = [
            'nombre' => $_POST['nombre'] ?? '',
            'descripcion' => $_POST['descripcion'] ?? '',
            'id_institucion' => $_SESSION['id_institucion']
        ];

        $model = new actividadModel();
        if ($model->crearActividad($datos)) {
            header('Location: index.php?action=verActividades'); // O la acción que uses para mostrar actividades
            exit;
        } else {
            echo "Error al crear la actividad.";
        }
    }
       public function listarPorInstitucion() {
        if (!isset($_SESSION['id_institucion'])) {
            echo "Institución no establecida.";
            return;
        }

        $idInstitucion = $_SESSION['id_institucion'];
        $model = new actividadModel();
        $actividades = $model->obtenerPorInstitucion($idInstitucion);

        // Mostrar las actividades con una vista simple (puede cambiar esto según tu estructura)
        require_once '../views/actividades/listar.php';
    }

        public static function actualizarActividad() {
        $id = $_POST['id_actividad'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];

        $model = new actividadModel();
        $model->actualizarActividad($id, $nombre, $descripcion);

        header('Location: index.php?action=verActividades');
        exit;
    }

    public static function eliminarActividad() {
        $id = $_GET['id'];
        $model = new actividadModel();
        $model->eliminarActividad($id);

        header('Location: index.php?action=verActividades');
        exit;
    }
    public static function mostrarDashboardInstitucion() {
    if (!isset($_SESSION['id_institucion'])) {
        // Redirigir a listado de instituciones si no hay institución seleccionada
        header('Location: index.php?action=listarInstituciones');
        exit;
    }

    $idInstitucion = $_SESSION['id_institucion'];

    // Supongamos que tienes un modelo InstitucionModel con método para obtener por ID
    require_once __DIR__     . '/../model/InstitucionModel.php';
    $model = new InstitucionModel();
    $institucion = $model->obtenerPorId($idInstitucion);

    // La vista recibirá $institucion para mostrar el nombre
    require __DIR__ . '/../views/instituciones/dashboard.php';
    }

    public function obtenerPorUsuario($idUsuario) {
    $pdo = getPDO(); // o $this->conn si estás usando conexión persistente
    $stmt = $pdo->prepare("
        SELECT i.*
        FROM instituciones i
        INNER JOIN usuario_instituciones ui ON i.id_institucion = ui.id_institucion
        WHERE ui.id_usuario = ?
    ");
    $stmt->execute([$idUsuario]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


}

