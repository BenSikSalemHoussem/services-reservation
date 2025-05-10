<?php
class Reservation {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createReservation($user_id, $service_id, $date_reservation) {
        $stmt = $this->db->prepare("INSERT INTO reservations (user_id, service_id, date_reservation, statut) VALUES (?, ?, ?, 'en_attente')");
        return $stmt->execute([$user_id, $service_id, $date_reservation]);
    }

    public function getReservationById($id) {
        $stmt = $this->db->prepare("SELECT r.*, u.nom as user_nom, s.nom as service_nom FROM reservations r JOIN users u ON r.user_id = u.id JOIN services s ON r.service_id = s.id WHERE r.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getReservationsByUserId($user_id) {
        $stmt = $this->db->prepare("SELECT r.*, s.nom as service_nom FROM reservations r JOIN services s ON r.service_id = s.id WHERE r.user_id = ? ORDER BY r.date_reservation DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllReservations() {
        $stmt = $this->db->query("SELECT r.*, u.nom as user_nom, s.nom as service_nom FROM reservations r JOIN users u ON r.user_id = u.id JOIN services s ON r.service_id = s.id ORDER BY r.date_reservation DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateReservationStatus($id, $statut) {
        $stmt = $this->db->prepare("UPDATE reservations SET statut = ? WHERE id = ?");
        return $stmt->execute([$statut, $id]);
    }

    public function deleteReservation($id) {
        $stmt = $this->db->prepare("DELETE FROM reservations WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>