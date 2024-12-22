<?php
require_once "includes/functions.php";

class User {
    private $conn;
    private $table_name = "utilisateurs";

    public $id;
    public $nom;
    public $email;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                 SET nom=:nom, email=:email, password=:password";

        $stmt = $this->conn->prepare($query);

        $this->nom = sanitize($this->nom);
        $this->email = sanitize($this->email);
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);

        if($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }

    public function authenticate() {
        $query = "SELECT id, nom, password FROM " . $this->table_name . " 
                 WHERE email = :email LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();

        return $stmt;
    }

    public function getUserById($id) {
        $query = "SELECT id, nom, email FROM " . $this->table_name . " 
                 WHERE id = :id LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function emailExists() {
        $query = "SELECT id FROM " . $this->table_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }
}
?>