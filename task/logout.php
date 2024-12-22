<?php
require_once "config/config.php";
require_once "controllers/UserController.php";

$userController = new UserController(null);
$userController->logout();