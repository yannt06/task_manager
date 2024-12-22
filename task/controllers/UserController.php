<?php
require_once "models/User.php";
require_once "includes/validation.php";
require_once "includes/session.php";
require_once "includes/functions.php";

class UserController {
    private $user;
    private $db;

    public function __construct($db) {
        $this->db = $db;
        $this->user = new User($db);
    }

    public function register() {
        if (Session::isLoggedIn()) {
            redirect("dashboard.php");
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $validation = validateRegistrationData($_POST);
            
            if (!$validation['isValid']) {
                $error = $validation['error'];
                require_once "views/register.php";
                return;
            }

            $this->user->nom = $_POST['nom'];
            $this->user->email = $_POST['email'];
            $this->user->password = $_POST['password'];

            if ($this->user->emailExists()) {
                $error = "Cet email est déjà utilisé";
                require_once "views/register.php";
                return;
            }

            if ($this->user->create()) {
                Session::set('user_id', $this->user->id);
                Session::set('user_nom', $this->user->nom);
                redirect("dashboard.php");
            } else {
                $error = "Erreur lors de la création du compte";
                require_once "views/register.php";
            }
        } else {
            require_once "views/register.php";
        }
    }

    public function login() {
        if (Session::isLoggedIn()) {
            redirect("dashboard.php");
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $validation = validateLoginData($_POST);
            
            if (!$validation['isValid']) {
                $error = $validation['error'];
                require_once "views/login.php";
                return;
            }

            $this->user->email = $_POST['email'];
            $stmt = $this->user->authenticate();
            
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($_POST['password'], $row['password'])) {
                    Session::set('user_id', $row['id']);
                    
                    Session::set('user_nom', $row['nom']);
                    redirect("dashboard.php");
                }
            }
            $error = "Email ou mot de passe incorrect";
            require_once "views/login.php";
        } else {
            require_once "views/login.php";
        }
    }

    public function profile() {
        Session::requireLogin();
        $userId = Session::get('user_id');
        $userInfo = $this->user->getUserById($userId);
        require_once "views/profile.php";
    }

    public function logout() {
        session_unset();
        session_destroy();
        Session::destroy();
        redirect("login.php");
    }
}
?>