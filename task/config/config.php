<?php
// Configuration générale
define('SITE_NAME', 'Gestionnaire de tâches');

// Configuration de la session
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); 
// Gestion des erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1); 