<?php
function redirect($url) {
    header("Location: " . $url);
    exit();
}

function getStatusClass($status) {
    switch ($status) {
        case 'Terminée':
            return 'status-completed';
        case 'En cours':
            return 'status-progress';
        default:
            return 'status-pending';
    }
}

function formatDate($date) {
    return date('d/m/Y H:i', strtotime($date));
}

function formatDateTime($date) {
    return date('d/m/Y H:i', strtotime($date));
}

function sanitize($data) {
    return htmlspecialchars(strip_tags($data));
}

function getBaseUrl() {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];
    $path = dirname($_SERVER['PHP_SELF']);
    return rtrim($protocol . $host . $path, '/');
}
?>