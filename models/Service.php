<?php
class Service {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createService($nom, $description, $prix, $image_path = null) {
        $stmt = $this->db->prepare("INSERT INTO services (nom, description, prix, image_path) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nom, $description, $prix, $image_path]);
    }

    public function getServiceById($id) {
        $stmt = $this->db->prepare("SELECT * FROM services WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllServices() {
        $stmt = $this->db->query("SELECT * FROM services");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateService($id, $nom, $description, $prix, $image_path = null) {
        $stmt = $this->db->prepare("UPDATE services SET nom = ?, description = ?, prix = ?, image_path = ? WHERE id = ?");
        return $stmt->execute([$nom, $description, $prix, $image_path, $id]);
    }

    public function deleteService($id) {
        $stmt = $this->db->prepare("DELETE FROM services WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>