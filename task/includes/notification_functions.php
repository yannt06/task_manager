<?php
function createTaskNotification($db, $task_id, $user_id, $type) {
    $notification = new Notification($db);
    $notification->id_tache = $task_id;
    $notification->id_utilisateur = $user_id;
    $notification->type = $type;

    switch ($type) {
        case 'deadline':
            $notification->message = "Une tâche arrive à échéance bientôt !";
            break;
        case 'completed':
            $notification->message = "Une tâche a été marquée comme terminée.";
            break;
        case 'reminder':
            $notification->message = "Rappel : vous avez une tâche à effectuer.";
            break;
    }

    return $notification->create();
}

function checkTaskDeadlines($db) {
    $query = "SELECT * FROM taches 
              WHERE date_echeance <= DATE_ADD(NOW(), INTERVAL 1 HOUR)
              AND notification_envoyee = false
              AND status != 'Terminée'";
    
    $stmt = $db->prepare($query);
    $stmt->execute();

    while ($task = $stmt->fetch(PDO::FETCH_ASSOC)) {
        createTaskNotification($db, $task['id'], $task['id_utilisateur'], 'deadline');
        
        // Marquer la notification comme envoyée
        $updateQuery = "UPDATE taches SET notification_envoyee = true WHERE id = :id";
        $updateStmt = $db->prepare($updateQuery);
        $updateStmt->bindParam(":id", $task['id']);
        $updateStmt->execute();
    }
}