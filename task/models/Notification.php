<?php
class Notification {
    private $conn;
    private $table_name = "notifications";

    public $id;
    public $id_tache;
    public $id_utilisateur;
    public $type;
    public $message;
    public $lu;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                 SET id_tache=:id_tache, id_utilisateur=:id_utilisateur,
                     type=:type, message=:message";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id_tache", $this->id_tache);
        $stmt->bindParam(":id_utilisateur", $this->id_utilisateur);
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":message", $this->message);

        return $stmt->execute();
    }

    public function getUserNotifications() {
        $query = "SELECT n.*, t.titre as titre_tache
                 FROM " . $this->table_name . " n
                 LEFT JOIN taches t ON n.id_tache = t.id
                 WHERE n.id_utilisateur = :id_utilisateur
                 ORDER BY n.created_at DESC
                 LIMIT 10";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_utilisateur", $this->id_utilisateur);
        $stmt->execute();

        return $stmt;
    }

    public function markAsRead() {
        $query = "UPDATE " . $this->table_name . "
                 SET lu = true
                 WHERE id = :id AND id_utilisateur = :id_utilisateur";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":id_utilisateur", $this->id_utilisateur);

        return $stmt->execute();
    }

    public function getUnreadCount() {
        $query = "SELECT COUNT(*) as count
                 FROM " . $this->table_name . "
                 WHERE id_utilisateur = :id_utilisateur AND lu = false";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_utilisateur", $this->id_utilisateur);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['count'];
    }
}