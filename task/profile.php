<?php
require_once "config/config.php";
require_once "config/database.php";
require_once "controllers/UserController.php";
require_once "includes/session.php";

Session::requireLogin();

$database = new Database();
$db = $database->getConnection();

$userController = new UserController($db);
$userController->profile();
?>