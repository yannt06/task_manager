<?php
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validatePassword($password) {
    return strlen($password) >= 8;
}

function validateDate($date) {
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') === $date;
}

function validateRegistrationData($data) {
    if (empty($data['nom'])) {
        return ['isValid' => false, 'error' => 'Le nom est requis'];
    }

    if (empty($data['email']) || !validateEmail($data['email'])) {
        return ['isValid' => false, 'error' => 'Email invalide'];
    }

    if (empty($data['password']) || !validatePassword($data['password'])) {
        return ['isValid' => false, 'error' => 'Le mot de passe doit contenir au moins 8 caractères'];
    }

    return ['isValid' => true];
}

function validateLoginData($data) {
    if (empty($data['email']) || !validateEmail($data['email'])) {
        return ['isValid' => false, 'error' => 'Email invalide'];
    }

    if (empty($data['password'])) {
        return ['isValid' => false, 'error' => 'Le mot de passe est requis'];
    }

    return ['isValid' => true];
}

function validateTaskData($data) {
    if (empty($data['titre'])) {
        return ['isValid' => false, 'error' => 'Le titre est requis'];
    }

    if (empty($data['description'])) {
        return ['isValid' => false, 'error' => 'La description est requise'];
    }

    if (empty($data['date_echeance']) || !validateDate($data['date_echeance'])) {
        return ['isValid' => false, 'error' => 'Date d\'échéance invalide'];
    }

    if (empty($data['id_categorie'])) {
        return ['isValid' => false, 'error' => 'La catégorie est requise'];
    }

    return ['isValid' => true];
}