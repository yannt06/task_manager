<?php
require_once "../config/config.php";
require_once "../config/database.php";
require_once "../models/Notification.php";
require_once "../includes/notification_functions.php";

$database = new Database();
$db = $database->getConnection();

checkTaskDeadlines($db);