<?php
function isAuthenticated() {
    return Session::isLoggedIn();
}

function requireAuth() {
    if (!isAuthenticated()) {
        header("Location: login.php");
        exit();
    }
}

function logout() {
    Session::destroy();
    header("Location: login.php");
    exit();
}