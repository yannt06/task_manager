<?php
require_once "config/config.php";
require_once "config/database.php";
require_once "includes/session.php";
require_once "controllers/TaskController.php";

Session::requireLogin();

$database = new Database();
$db = $database->getConnection();

$taskController = new TaskController($db);
$taskController->edit();
?>