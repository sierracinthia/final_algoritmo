<?php
require_once __DIR__ . '/../model/UsuarioModel.php';
require_once __DIR__ . '/../model/PersonaModel.php';
require_once __DIR__ . '/../config/database.php';  // para getPDO()


class AuthController {
    public static function showHome() {
        include __DIR__ . '/../views/home.php';
    }

    public static function showLogin() {
        include __DIR__ . '/../views/login.php';
    }

    public static function showRegister() {
        include '../views/register.php';
    }

    public static function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getUsuarioByEmail($email);

            if ($usuario && password_verify($password, $usuario['contraseña'])) {
                $_SESSION['user_id'] = $usuario['id_usuario'];
                $_SESSION['user_name'] = $usuario['nombre'] . ' ' . $usuario['apellido'];

                // Redirigir al dashboard
                header("Location: index.php?action=dashboard");
                exit();
            } else {
                echo "Credenciales incorrectas.";
            }
        }
    }
    public static function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pdo = getPDO();

            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $dni = $_POST['dni'];
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Verificar si email ya existe
            $stmtCheck = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
            $stmtCheck->execute([$email]);
            if ($stmtCheck->fetch()) {
                echo "El email ya está registrado.";
                return;
            }

            // Insertar persona
            $stmtPersona = $pdo->prepare("INSERT INTO persona (dni, nombre, apellido, fecha_nacimiento) VALUES (?, ?, ?, ?)");
            $stmtPersona->execute([$dni, $nombre, $apellido, $fecha_nacimiento]);
            $id_persona = $pdo->lastInsertId();

            // Insertar usuario
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmtUsuario = $pdo->prepare("INSERT INTO usuarios (email, contraseña, id_persona, id_rol) VALUES (?, ?, ?,?)");
            $idRol = 2; // Administrador
            $stmtUsuario->execute([$email, $hash, $id_persona,$idRol]);

            // Redirigir al home
            header('Location: index.php?action=home');
            exit();
        }
    }
    public static function showDashboard(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit();
        }

        $userName = $_SESSION['user_name'];
        include __DIR__ . '/../views/dashboard.php';
    }

    public static function logout() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    session_unset();
    session_destroy();
    header("Location: index.php?action=login");
    exit();
    }
    public static function mostrarPerfil() {
     //   session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $idUsuario = $_SESSION['user_id'];
        $model = new UsuarioModel();
        $usuario = $model->obtenerPorId($idUsuario);

        include __DIR__ . '/../views/perfil_usuario.php';
    }

    public static function actualizarPerfil() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?action=login');
        exit;
    }
        
        $idUsuario = $_SESSION['user_id'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $contraseña = $_POST['password']?? null;

        $usuarioModel = new UsuarioModel();
        $actualizado = $usuarioModel->actualizarUsuario($idUsuario, $nombre, $apellido, $email, $contraseña);

        if ($actualizado) {
        header('Location: index.php?action=perfilUsuario&mensaje=actualizado');
        } else {
            echo "Error al actualizar los datos";
        }
    }


    public static function eliminarCuenta() {
     //   session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $idUsuario = $_SESSION['user_id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $confirmar = $_POST['confirmar'] ?? '';

            if ($confirmar === 'SI') {
                $model = new UsuarioModel();
                $exito = $model->eliminarUsuario($idUsuario);

                if ($exito) {
                    session_destroy();
                    header('Location: index.php?action=register&msg=cuenta_eliminada');
                    exit;
                } else {
                    echo "Error al eliminar la cuenta.";
                }
            } else {
                header('Location: index.php?action=perfilUsuario');
                exit;
            }
        } else {
            include __DIR__ . '/../views/confirmar_eliminar.php';
        }
    }

}
