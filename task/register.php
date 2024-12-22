<?php
require_once "config/config.php";
require_once "config/database.php";
require_once "controllers/UserController.php";

$database = new Database();
$db = $database->getConnection();

$userController = new UserController($db);
$userController->register();