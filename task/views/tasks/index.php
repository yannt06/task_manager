<?php 
$pageTitle = "Mes tâches";
require_once "includes/header.php";
?>

<div class="dashboard-container">
    <?php require_once "includes/sidebar.php"; ?>
    
    <main class="main-content">
        <div class="content-header">
            <h1>Mes tâches</h1>
            <a href="create.php" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nouvelle tâche
            </a>
        </div>

        <div class="tasks-grid">
            <?php if ($tasks && $tasks->rowCount() > 0): ?>
                <?php while ($task = $tasks->fetch(PDO::FETCH_ASSOC)): ?>
                    <div class="task-card">
                        <div class="task-header">
                            <h3><?php echo htmlspecialchars($task['titre']); ?></h3>
                            <span class="status-badge <?php echo getStatusClass($task['status']); ?>">
                                <?php echo htmlspecialchars($task['status'] ?? "En attente") ; ?>
                            </span>
                        </div>
                        <div class="task-body">
                            <p><?php echo htmlspecialchars($task['description']); ?></p>
                            <div class="task-meta">
                                <span>
                                    <i class="fas fa-calendar"></i>
                                    <?php echo Date('Y-m-d', strtotime($task['date_echeance']) ); ?>
                                    <?php echo $task['heure_echeance']; ?>
                                </span>
                                <span>
                                    <i class="fas fa-tag"></i>
                                    <?php echo htmlspecialchars($task['nom_categorie']); ?>
                                </span>
                            </div>
                            <div class="task-actions">
                                <?php if ($task['status'] !== 'Terminée'): ?>
                                    <a href="complete_task.php?id=<?php echo $task['id']; ?>" 
                                       class="btn btn-success"
                                       onclick="return confirm('Marquer cette tâche comme terminée ?')">
                                        <i class="fas fa-check"></i> Marquer comme terminée
                                    </a>
                                <?php endif; ?>
                                <a href="edit.php?id=<?php echo $task['id']; ?>" class="btn btn-edit">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                                <a href="delete.php?id=<?php echo $task['id']; ?>" 
                                   class="btn btn-delete"
                                   onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')">
                                    <i class="fas fa-trash"></i> Supprimer
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="no-tasks">
                    <p>Aucune tâche pour le moment</p>
                </div>
            <?php endif; ?>
        </div>
    </main>
</div>

<?php require_once "includes/footer.php"; ?>