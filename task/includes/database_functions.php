<?php
function connectDatabase() {
    $database = new Database();
    return $database->getConnection();
}

function executeQuery($conn, $query, $params = []) {
    try {
        $stmt = $conn->prepare($query);
        $stmt->execute($params);
        return $stmt;
    } catch(PDOException $e) {
        error_log("Erreur SQL: " . $e->getMessage());
        throw $e;
    }
}

function getLastInsertId($conn) {
    return $conn->lastInsertId();
}

function beginTransaction($conn) {
    return $conn->beginTransaction();
}

function commitTransaction($conn) {
    return $conn->commit();
}

function rollbackTransaction($conn) {
    return $conn->rollBack();
}
?>