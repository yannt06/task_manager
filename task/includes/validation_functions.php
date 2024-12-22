<?php
function validateRequired($value, $fieldName) {
    if (empty($value)) {
        return ["isValid" => false, "error" => "Le champ $fieldName est requis"];
    }
    return ["isValid" => true];
}

function validateEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return ["isValid" => false, "error" => "Format d'email invalide"];
    }
    return ["isValid" => true];
}

function validateLength($value, $fieldName, $min, $max) {
    $length = strlen($value);
    if ($length < $min || $length > $max) {
        return ["isValid" => false, "error" => "Le champ $fieldName doit contenir entre $min et $max caractères"];
    }
    return ["isValid" => true];
}

function validateDate($date) {
    $d = DateTime::createFromFormat('Y-m-d', $date);
    if (!$d || $d->format('Y-m-d') !== $date) {
        return ["isValid" => false, "error" => "Format de date invalide"];
    }
    return ["isValid" => true];
}

function validateTime($time) {
    $t = DateTime::createFromFormat('H:i', $time);
    if (!$t || $t->format('H:i') !== $time) {
        return ["isValid" => false, "error" => "Format d'heure invalide"];
    }
    return ["isValid" => true];
}
?>