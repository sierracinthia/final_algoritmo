<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../config/database.php';
require_once '../controllers/AuthController.php';
require_once '../controllers/InstitucionController.php';


$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'login':
        // Muestra el formulario de login
        AuthController::showLogin();
        break;
    case 'doLogin':
        // Procesa el login con los datos enviados por POST
        AuthController::login();
        break;
    case 'logout':
        // Cierra la sesión del usuario
        AuthController::logout();
        break;

    case 'dashboard':
        // Muestra el panel principal después de loguearse
        AuthController::showDashboard();
        break;

    case 'register':
        // Muestra el formulario para registrarse
        AuthController::showRegister();
        break;
    case 'doRegister':
        // Procesa el registro del usuario
        AuthController::register();
        break;

    case 'home':
        // Muestra la página de inicio o home (página principal)
        AuthController::showHome();
        break;

    case 'mostrarFormularioCrearInstitucion':
        // Muestra formulario para crear una nueva institución
        InstitucionController::mostrarFormularioCrear();
        break;

    case 'crearInstitucion':
        // Procesa el alta de una nueva institución
        InstitucionController::crear();
        break;

    case 'listarInstituciones':
        // Muestra el listado de instituciones
        InstitucionController::listar();
        break;

    case 'desactivarInstitucion':
        // Cambia el estado (activo/inactivo) de una institución
        InstitucionController::cambiarEstado();
        break;

    case 'editarInstitucion':
        // Muestra el formulario para editar una institución existente
        InstitucionController::editar();
        break;

    case 'guardarCambiosInstitucion':
        // Procesa el guardado de los cambios en la institución (POST)
        InstitucionController::guardar();
        break;

    case 'entrarInstitucion':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $_SESSION['id_institucion'] = $id;
            header("Location: index.php?action=institucionDashboard");
            exit;
        } else {
            // Manejo de error por si no hay ID
            echo "ID de institución no válido.";
        }
        break;

    
        //    case 'institucionDashboard':
        //        include __DIR__ . '/../views/instituciones/dashboard.php';
        //       break;

    case 'institucionesDashboard': // plural para el dashboard general
        require_once '../controllers/InstitucionController.php';
        InstitucionController::mostrarDashboardGeneral();
        break;

    case 'institucionDashboard':
        require_once '../controllers/InstitucionController.php';
        InstitucionController::mostrarDashboardInstitucion();
        break;


    case 'salirInstitucion':
        unset($_SESSION['id_institucion']);
        InstitucionController::salirInstitucion();
        break;

    case 'verActividades':
        // Muestra el listado de actividades para la institución activa
        require_once '../controllers/actividadController.php';
        $controller = new actividadController();
        $controller->listarPorInstitucion();
        break;

    case 'crearActividad':
        // Muestra formulario para crear nueva actividad
        require_once '../controllers/actividadController.php';
        actividadController::mostrarFormularioCrear();
        break;

    case 'guardarActividad':
        // Procesa el guardado de una nueva actividad (POST)
        require_once '../controllers/actividadController.php';
        actividadController::guardarActividad();
        break;

    case 'actualizarActividad':
        // Procesa la actualización de una actividad existente (POST)
        require_once '../controllers/actividadController.php';
        actividadController::actualizarActividad();
        break;

    case 'eliminarActividad':
        // Elimina una actividad (por GET o POST)
        require_once '../controllers/actividadController.php';
        actividadController::eliminarActividad();
        break;

    case 'perfilUsuario':
        AuthController::mostrarPerfil();
        break;
    case 'actualizarPerfil':
        AuthController::actualizarPerfil();
        break;  
    case 'eliminarCuenta':
        AuthController::eliminarCuenta();
        break;
    default:
        // Si no coincide ninguna acción, muestra la página de inicio
        AuthController::showHome();
        break;
}
