<?php
class InstitucionModel {
    private $conn;

    public function __construct() {
        global $pdo;  // Usamos la conexión PDO global
        $this->conn = $pdo;
    }

    public function crearInstitucion($nombre, $codigo_entidad, $id_localizacion = null) {
        $stmt = $this->conn->prepare("
            INSERT INTO instituciones (nombre, codigo_entidad, id_localizacion) 
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$nombre, $codigo_entidad, $id_localizacion]);
    }

    public function obtenerInstituciones() {
        $stmt = $this->conn->prepare("SELECT i.id_institucion, i.nombre, i.codigo_entidad,
                                  l.calle, l.numero,i.estado
                           FROM instituciones i
                           LEFT JOIN Localizacion l ON i.id_localizacion = l.id_localizacion");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function obtenerPorIdConLocalizacion($id) {
    $pdo = getPDO();
    $stmt = $pdo->prepare("
        SELECT i.*, l.calle, l.numero, l.cod_postal, l.departamento, l.piso
        FROM instituciones i
        LEFT JOIN Localizacion l ON i.id_localizacion = l.id_localizacion
        WHERE i.id_institucion = ?
    ");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function actualizarInstitucionYLocalizacion($idInstitucion, $nombre, $codigo, $idLocalizacion, $calle, $numero,$codPostal, $departamento,$piso) {
        $pdo = getPDO();
        $pdo->beginTransaction();

        try {
            $stmt1 = $pdo->prepare("UPDATE instituciones SET nombre = ?, codigo_entidad = ? WHERE id_institucion = ?");
            $stmt1->execute([$nombre, $codigo, $idInstitucion]);

            $stmt2 = $pdo->prepare("UPDATE Localizacion SET calle = ?, numero = ?,  cod_postal = ?,departamento = ?, piso =? WHERE id_localizacion = ?");
            $stmt2->execute([$calle, $numero, $codPostal, $departamento, $piso, $idLocalizacion]);

            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            $pdo->rollBack();
            echo "Error en la actualización: " . $e->getMessage();
            return false;
        }
    }
    public static function cambiarEstado($id, $estado) {
    $pdo = getPDO();
    $stmt = $pdo->prepare("UPDATE instituciones SET estado = ? WHERE id_institucion = ?");
    return $stmt->execute([$estado, $id]);
    }

    public static function obtenerNombreInstitucion($idInstitucion) {
        $pdo = getPDO();  // o global $pdo si usás variable global
        $stmt = $pdo->prepare("SELECT nombre FROM instituciones WHERE id_institucion = ? LIMIT 1");
        $stmt->execute([$idInstitucion]);

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($resultado) {
            return $resultado['nombre'];
        }
        return null;
    }
    public function obtenerPorId($id) {
    $pdo = getPDO(); 
    $stmt = $pdo->prepare("SELECT * FROM instituciones WHERE id_institucion = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function usuarioTieneAcceso($idUsuario, $idInstitucion) {
    $pdo = getPDO();
    $stmt = $pdo->prepare("SELECT 1 FROM usuario_instituciones WHERE id_usuario = ? AND id_institucion = ?");
    $stmt->execute([$idUsuario, $idInstitucion]);
    return $stmt->fetchColumn() !== false;
    }

    public function obtenerPorUsuario($idUsuario) {
        $stmt = $this->conn->prepare("
            SELECT i.*, l.calle, l.numero
            FROM instituciones i
            INNER JOIN usuario_instituciones ui ON i.id_institucion = ui.id_institucion
            LEFT JOIN Localizacion l ON i.id_localizacion = l.id_localizacion
            WHERE ui.id_usuario = ?
        ");
        $stmt->execute([$idUsuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}