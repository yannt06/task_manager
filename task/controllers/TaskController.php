<?php
require_once "models/Task.php";
require_once "models/Category.php";
require_once "includes/functions.php";
require_once "includes/validation.php";
require_once "includes/session.php";

class TaskController {
    private $task;
    private $category;
    private $db;

    public function __construct($db) {
        $this->db = $db;
        $this->task = new Task($db);
        $this->category = new Category($db);
    }

    public function index() {
        $this->task->id_utilisateur = Session::get('user_id');
        $tasks = $this->task->readAll();
        $categories = $this->category->readAll();
        require_once "views/tasks/index.php";
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $validation = validateTaskData($_POST);
            
            if (!$validation['isValid']) {
                $error = $validation['error'];
                $categories = $this->category->readAll();
                require_once "views/tasks/create.php";
                return;
            }

            $this->task->titre = $_POST['titre'];
            $this->task->description = $_POST['description'];
            $this->task->date_debut = $_POST['date_debut'];
            $this->task->heure_debut = $_POST['heure_debut'];
            $this->task->date_echeance = $_POST['date_echeance'];
            $this->task->heure_echeance = $_POST['heure_echeance'];
            $this->task->status = 'En attente';
            $this->task->id_utilisateur = Session::get('user_id');
            $this->task->id_categorie = $_POST['id_categorie'];

            if ($this->task->create()) {
                redirect("index.php");
            } else {
                $error = "Erreur lors de la création de la tâche";
                $categories = $this->category->readAll();
                require_once "views/tasks/create.php";
            }
        } else {
            $categories = $this->category->readAll();
            require_once "views/tasks/create.php";
        }
    }

    public function edit() {
        if (!isset($_GET['id'])) {
            redirect("index.php");
        }

        $this->task->id = $_GET['id'];
        $this->task->id_utilisateur = Session::get('user_id');
        $task = $this->task->readOne();

        if (!$task) {
            redirect("index.php");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $validation = validateTaskData($_POST);
            
            if (!$validation['isValid']) {
                $error = $validation['error'];
                $categories = $this->category->readAll();
                require_once "views/tasks/edit.php";
                return;
            }

            $this->task->titre = $_POST['titre'];
            $this->task->description = $_POST['description'];
            $this->task->date_debut = $_POST['date_debut'];
            $this->task->heure_debut = $_POST['heure_debut'];
            $this->task->date_echeance = $_POST['date_echeance'];
            $this->task->heure_echeance = $_POST['heure_echeance'];
            $this->task->id_categorie = $_POST['id_categorie'];

            if ($this->task->update()) {
                redirect("index.php");
            } else {
                $error = "Erreur lors de la modification de la tâche";
                $categories = $this->category->readAll();
                require_once "views/tasks/edit.php";
            }
        } else {
            $categories = $this->category->readAll();
            require_once "views/tasks/edit.php";
        }
    }

    public function delete() {
        if (!isset($_GET['id'])) {
            redirect("index.php");
        }

        $this->task->id = $_GET['id'];
        $this->task->id_utilisateur = Session::get('user_id');

        if ($this->task->delete()) {
            redirect("index.php");
        } else {
            redirect("index.php");
        }
    }

    public function markAsCompleted() {
        if (!isset($_GET['id'])) {
            redirect("index.php");
        }

        $this->task->id = $_GET['id'];
        $this->task->id_utilisateur = Session::get('user_id');

        if ($this->task->markAsCompleted()) {
            redirect("index.php");
        } else {
            redirect("index.php");
        }
    }

    public function dashboard() {
        Session::requireLogin();
        $this->task->id_utilisateur = Session::get('user_id');
        
        $stats = [
            'en_cours' => $this->task->countByStatus('En cours'),
            'a_faire' => $this->task->countByStatus('En attente'),
            'terminees' => $this->task->countByStatus('Terminée'),
            'total' => $this->task->countTotal()
        ];
        
        $recentTasks = $this->task->getRecentTasks();
        $stautstask = $this->task->Statut();
        $upcomingTasks = $this->task->getUpcomingTasks();
        
        require_once "views/dashboard.php";
    }

    public function afficherstatut(){
        $stats = $this->task->Statut();
    }
}
?>