<?php
//session_start(); 
require_once __DIR__ . '/../model/InstitucionModel.php';

class InstitucionController {
    public static function mostrarFormularioCrear() {
        include __DIR__ . '/../views/instituciones/crear.php';
    }

    public static function crear() {

         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $codigo_entidad = $_POST['codigo_entidad'] ?? '';
            $calle = $_POST['calle'] ?? null;
            $numero = $_POST['numero'] ?? null;
            $codPostal = $_POST['cod_postal'] ?? null;
            $departamento = $_POST['departamento'] ?? null;
            $piso = $_POST['piso'] ?? null;

            // Convertir valores vacíos a NULL
            $numero = ($numero === '') ? null : $numero;
            $departamento = ($departamento === '') ? null : $departamento;
            $piso = ($piso === '') ? null : $piso;

            $pdo = getPDO();
            $model = new InstitucionModel();

            try {
            $pdo->beginTransaction();

            // Insertar localización (aunque esté incompleta)
            $stmtLoc = $pdo->prepare("INSERT INTO Localizacion (calle, numero, cod_postal, departamento, piso)
                                     VALUES (?, ?, ?, ?, ?)");
            $stmtLoc->execute([$calle, $numero, $codPostal, $departamento, $piso]);
            $idLocalizacion = $pdo->lastInsertId();

            // Insertar institución
            $stmtInst = $pdo->prepare("INSERT INTO instituciones (nombre, codigo_entidad, id_localizacion)
                                      VALUES (?, ?, ?)");
            $stmtInst->execute([$nombre, $codigo_entidad, $idLocalizacion]);
            $idInstitucion = $pdo->lastInsertId();

            //validar la sesion
            //if (!isset($_SESSION['id_usuario'])) {
            //header('Location: index.php?action=login');
            //exit;
            //}

            // Asociar al usuario actual como administrador
            $idUsuario = $_SESSION['user_id'];

            $idRol = 2; // Por ejemplo: 2 = administrador

            $stmtRel = $pdo->prepare("INSERT INTO usuario_instituciones (id_usuario, id_institucion, id_rol, estado)
                                     VALUES (?, ?, ?, 1)");
            $stmtRel->execute([$idUsuario, $idInstitucion, $idRol]);

            $pdo->commit();
            header("Location: index.php?action=listarInstituciones");
//           var_dump($idUsuario, $idInstitucion, $idRol);
            $pdo->commit();

            exit; // Evita que siga a la redirección

            exit;
        } catch (PDOException $e) {
            $pdo->rollBack();
            echo "Error al crear institución: " . $e->getMessage();
        }
        }
    }

    public static function listar() {

        // 1. Validar sesión
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        // 2. Obtener instituciones asociadas al usuario
        $idUsuario = $_SESSION['user_id'];
        $model = new InstitucionModel();
        $instituciones = $model->obtenerPorUsuario($idUsuario);

        // 3. Siempre mostrar la vista (aunque no tenga instituciones)
        include __DIR__ . '/../views/instituciones/listar.php';
    }

    public static function editar() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? null;
        $nombre = $_POST['nombre'];
        $codigo = $_POST['codigo_entidad'];
        $idLocalizacion = $_POST['id_localizacion'] ?? null;  // importante traerlo del formulario
        $calle = $_POST['calle'];
        $numero = $_POST['numero'];
        $codPostal = $_POST['cod_postal'];
        $departamento = $_POST['departamento']?? null;
        $piso = $_POST['piso'] ?? '';

        $departamento = ($departamento === '') ? null : $departamento;
        $piso = ($piso === '') ? null : $piso;
        
        if (InstitucionModel::actualizarInstitucionYLocalizacion($id, $nombre, $codigo,$idLocalizacion,$calle,$numero,$codPostal,$departamento,$piso)) {
            header("Location: index.php?action=listarInstituciones");
        } else {
            echo "Error al actualizar.";
        }
    } else {
        $id = $_GET['id'];
        $institucion = InstitucionModel::obtenerPorIdConLocalizacion($id);
        include __DIR__ . '/../views/instituciones/editar_institucion.php';
    }
    }

    public static function cambiarEstado() {    
        $id = $_GET['id'] ?? null;
        $estado = $_GET['estado'] ?? null;
        if ($id !== null && $estado !== null) {
            if (InstitucionModel::cambiarEstado($id, $estado)) {
                header("Location: index.php?action=listarInstituciones");
                exit();
            } else {
                echo "Error al cambiar estado.";
            }
        }else {
            echo "Parámetros inválidos.";
        }
    
        
    }
    public static function mostrarDashboardInstitucion() {
        if (!isset($_SESSION['id_institucion']) || !isset($_SESSION['user_id' ])) {
            header('Location: index.php?action=listarInstituciones');
            exit;
        }

        $idInstitucion = $_SESSION['id_institucion'];
        $idUsuario = $_SESSION['user_id'];

        require_once __DIR__ . '/../model/InstitucionModel.php';
        $model = new InstitucionModel();

        // Verificamos si la institución pertenece al usuario
        if (!$model->usuarioTieneAcceso($idUsuario, $idInstitucion)) {
            echo "Acceso denegado: esta institución no te pertenece.";
            exit;
        }

        $institucion = $model->obtenerPorId($idInstitucion);

        if (!$institucion) {
            die("No se encontró la institución.");
        }

        require __DIR__ . '/../views/instituciones/dashboard.php';
    }
    public static function salirInstitucion() {
        unset($_SESSION['id_institucion']); // Elimina solo esa variable
        header('Location: index.php?action=listarInstituciones');
        exit;
    }



}
