<?php
class Service {
    private $pdo;

    // Constructor for establishing the PDO connection
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create a new service
    public function create($title, $desc, $img) {
        $stmt = $this->pdo->prepare("INSERT INTO services (title, description, image) VALUES (:title, :desc, :img)");
        $stmt->execute([
            'title' => $title,
            'desc' => $desc,
            'img' => $img
        ]);
    }

    // Read all services
    public function readAll() {
        $stmt = $this->pdo->query("SELECT * FROM services");
        return $stmt->fetchAll();
    }

    // Update a service
    public function update($id, $title, $desc) {
        $stmt = $this->pdo->prepare("UPDATE services SET title = :title, description = :desc WHERE id = :id");
        $stmt->execute([
            'id' => $id,
            'title' => $title,
            'desc' => $desc
        ]);
    }

    // Delete a service
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM services WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    // Search services
    public function search($keyword) {
        $stmt = $this->pdo->prepare("SELECT * FROM services WHERE title LIKE :keyword OR description LIKE :keyword");
        $stmt->execute(['keyword' => "%$keyword%"]);
        return $stmt->fetchAll();
    }
}
?>
