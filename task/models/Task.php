<?php
class Task {
    private $conn;
    private $table_name = "taches";

    public $id;
    public $titre;
    public $description;
    public $date_debut;
    public $heure_debut;
    public $date_echeance;
    public $heure_echeance;
    public $status;
    public $id_utilisateur;
    public $id_categorie;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getRecentTasks() {
        $query = "SELECT t.*, c.nom_categorie 
                 FROM " . $this->table_name . " t
                 LEFT JOIN categories c ON t.id_categorie = c.id
                 WHERE t.id_utilisateur = :id_utilisateur
                 ORDER BY t.created_at DESC
                 LIMIT 5";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_utilisateur", $this->id_utilisateur);
        $stmt->execute();

        return $stmt;
    }

    public function getUpcomingTasks() {
        $query = "SELECT t.*, c.nom_categorie 
                 FROM " . $this->table_name . " t
                 LEFT JOIN categories c ON t.id_categorie = c.id
                 WHERE t.id_utilisateur = :id_utilisateur
                   AND t.status != 'Terminée'
                   AND t.date_echeance >= CURRENT_DATE
                 ORDER BY t.date_echeance ASC
                 LIMIT 5";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_utilisateur", $this->id_utilisateur);
        $stmt->execute();

        return $stmt;
    }

    public function countByStatus($status) {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name . " 
                 WHERE status = :status AND id_utilisateur = :id_utilisateur";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":id_utilisateur", $this->id_utilisateur);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    public function countTotal() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name . " 
                 WHERE id_utilisateur = :id_utilisateur";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_utilisateur", $this->id_utilisateur);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                 SET titre=:titre, description=:description, 
                     date_debut=:date_debut, heure_debut=:heure_debut,
                     date_echeance=:date_echeance, heure_echeance=:heure_echeance, status=:status, 
                     id_utilisateur=:id_utilisateur, id_categorie=:id_categorie";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":titre", $this->titre);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":date_debut", $this->date_debut);
        $stmt->bindParam(":heure_debut", $this->heure_debut);
        $stmt->bindParam(":date_echeance", $this->date_echeance);
        $stmt->bindParam(":heure_echeance", $this->heure_echeance);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":id_utilisateur", $this->id_utilisateur);
        $stmt->bindParam(":id_categorie", $this->id_categorie);

        return $stmt->execute();
    }

    public function readAll() {
        $query = "SELECT t.*, c.nom_categorie 
                 FROM " . $this->table_name . " t
                 LEFT JOIN categories c ON t.id_categorie = c.id
                 WHERE t.id_utilisateur = :id_utilisateur
                 ORDER BY t.date_echeance ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_utilisateur", $this->id_utilisateur);
        $stmt->execute();

        return $stmt;
    }

    public function readOne() {
        $query = "SELECT t.*, c.nom_categorie 
                 FROM " . $this->table_name . " t
                 LEFT JOIN categories c ON t.id_categorie = c.id
                 WHERE t.id = :id AND t.id_utilisateur = :id_utilisateur";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":id_utilisateur", $this->id_utilisateur);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . "
                 SET titre=:titre, description=:description,
                     date_debut=:date_debut, heure_debut=:heure_debut,
                     date_echeance=:date_echeance,
                     id_categorie=:id_categorie
                 WHERE id=:id AND id_utilisateur=:id_utilisateur";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":titre", $this->titre);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":date_debut", $this->date_debut);
        $stmt->bindParam(":heure_debut", $this->heure_debut);
        $stmt->bindParam(":date_echeance", $this->date_echeance);
        $stmt->bindParam(":id_categorie", $this->id_categorie);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":id_utilisateur", $this->id_utilisateur);

        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " 
                 WHERE id = :id AND id_utilisateur = :id_utilisateur";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":id_utilisateur", $this->id_utilisateur);

        return $stmt->execute();
    }

    public function markAsCompleted() {
        $query = "UPDATE " . $this->table_name . "
                 SET status = 'Terminée'
                 WHERE id = :id AND id_utilisateur = :id_utilisateur";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":id_utilisateur", $this->id_utilisateur);

        return $stmt->execute();
    }

    public function Statut() {
        $heurecatu= date('H:i:s');
        $query = "UPDATE " . $this->table_name . "
                 SET status = 'En cours'
                 WHERE date_debut <= :heurecatu";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":heurecatu", $heurecatu);
        return $stmt->execute();
    }
}
?>