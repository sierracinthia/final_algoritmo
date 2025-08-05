<?php
class UsuarioModel {
    private $pdo;

    public function __construct() {
        $this->pdo = getPDO();
    }

   // public function crearUsuario($email, $password, $id_persona) {
   //     $stmt = $this->pdo->prepare("INSERT INTO usuarios (email, contraseña, id_persona) VALUES (?, ?, ?)");
   //     return $stmt->execute([$email, $password, $id_persona]);
    //}
    
    public function getUsuarioByEmail($email) {
    $stmt = $this->pdo->prepare("
        SELECT u.*, p.nombre, p.apellido 
        FROM usuarios u 
        JOIN persona p ON u.id_persona = p.id_persona 
        WHERE u.email = ?
    ");
    $stmt->execute([$email]);
    return $stmt->fetch();
    }

    public function obtenerPorId($id_usuario) {
        $stmt = $this->pdo->prepare( "
            SELECT u.id_usuario, u.email, p.nombre, p.apellido, p.fecha_nacimiento
            FROM usuarios u
            JOIN persona p ON u.id_persona = p.id_persona
            WHERE u.id_usuario = ?
        ");

        $stmt->execute([$id_usuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function actualizarUsuario($idUsuario, $nombre, $apellido, $email, $contraseña) {
        // 1. Obtener el id_persona asociado a este usuario
        $sql = "SELECT id_persona FROM usuarios WHERE id_usuario = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$idUsuario]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return false;
        }

        $idPersona = $row['id_persona'];

        // 2. Actualizar nombre y apellido en persona
        $sql = "UPDATE persona SET nombre = ?, apellido = ? WHERE id_persona = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nombre, $apellido, $idPersona]);

        // 3. Solo actualizar contraseña si se proporcionó una nueva
        if (!empty($contraseña)) {
            $contraseñaHasheada = password_hash($contraseña, PASSWORD_DEFAULT);
            $sql = "UPDATE usuarios SET contraseña = ? WHERE id_usuario = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$contraseñaHasheada, $idUsuario]);
        }

        // 4. Actualizar email en contacto
        $sql = "UPDATE contacto SET contacto_valor = ? 
                WHERE id_persona = ? 
                AND id_tipo_contacto = (
                    SELECT id_tipo_contacto FROM tipo_contacto WHERE nombre_tipo = 'email' LIMIT 1
                )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email, $idPersona]);

        return true;
    }



    public function eliminarUsuario($id) {
        $stmt = $this->pdo->prepare("DELETE FROM usuarios WHERE id_usuario = ?");
        return $stmt->execute([$id]);
    }


}
