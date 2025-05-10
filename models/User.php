<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createUser($nom, $email, $mot_de_passe) {
        $hashedPassword = password_hash($mot_de_passe, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (nom, email, mot_de_passe) VALUES (?, ?, ?)");
        return $stmt->execute([$nom, $email, $hashedPassword]);
    }

    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers() {
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateUser($id, $nom, $email) {
        $stmt = $this->db->prepare("UPDATE users SET nom = ?, email = ? WHERE id = ?");
        return $stmt->execute([$nom, $email, $id]);
    }

    public function deleteUser($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>