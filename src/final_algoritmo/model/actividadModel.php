<?php
require_once __DIR__ . '/../config/database.php';

class actividadModel {
    private $db;

    public function __construct() {
        $this->db = getPDO();
    }

    public function obtenerPorInstitucion($idInstitucion) {
        $stmt = $this->db->prepare("SELECT * FROM actividad WHERE id_institucion = ?");
        $stmt->execute([$idInstitucion]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearActividad($datos) {
        $stmt = $this->db->prepare("INSERT INTO actividad (nombre, descripcion, id_institucion, estado) VALUES (?, ?, ?, 1)");
        return $stmt->execute([
            $datos['nombre'],
            $datos['descripcion'],
            $datos['id_institucion']
        ]);
    }

    public function actualizarActividad($id, $nombre, $descripcion) {
        $db = getPDO();
        $stmt = $db->prepare("UPDATE actividad SET nombre = ?, descripcion = ? WHERE id_actividad = ?");
        return $stmt->execute([$nombre, $descripcion, $id]);
    }

    public function eliminarActividad($id) {
        $db = getPDO();
        $stmt = $db->prepare("DELETE FROM actividad WHERE id_actividad = ?");
        return $stmt->execute([$id]);
    }

}
