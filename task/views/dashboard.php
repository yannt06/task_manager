<?php 
$pageTitle = "Tableau de bord";
require_once "includes/header.php";

?>

<div class="dashboard-container">
    <?php require_once "includes/sidebar.php"; ?>
    
    <main class="main-content">
        <div class="content-header">
            <h1>Tableau de bord</h1>
        </div>

        <div class="dashboard-stats">
            <div class="stat-card">
                <h3>Tâches en cours</h3>
                <div class="number"><?php echo $stats['en_cours']; ?></div>
            </div>
            <div class="stat-card">
                <h3>À faire</h3>
                <div class="number"><?php echo $stats['a_faire']; ?></div>
            </div>
            <div class="stat-card">
                <h3>Terminées</h3>
                <div class="number"><?php echo $stats['terminees']; ?></div>
            </div>
            <div class="stat-card">
                <h3>Total</h3>
                <div class="number"><?php echo $stats['total']; ?></div>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="dashboard-card">
                <h2>Tâches récentes</h2>
                <div class="tasks-list">
                    <?php if ($recentTasks && $recentTasks->rowCount() > 0): ?>
                        <?php while ($task = $recentTasks->fetch(PDO::FETCH_ASSOC)): ?>
                            <div class="task-item">
                                <div class="task-info">
                                    <h4><?php echo htmlspecialchars($task['titre']); ?></h4>
                                    <span class="status-badge <?php echo getStatusClass($task['status'] ?? "En Attente"); ?>">
                                        <?php echo htmlspecialchars($task['status'] ?? "En Attente"); ?>
                                    </span>
                                </div>
                                <div class="task-meta">
                                    <span>Échéance: <?php echo formatDate($task['date_echeance']); ?></span>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>Aucune tâche récente</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="dashboard-card">
                <h2>Tâches à venir</h2>
                <div class="tasks-list">
                    <?php if ($upcomingTasks && $upcomingTasks->rowCount() > 0): ?>
                        <?php while ($task = $upcomingTasks->fetch(PDO::FETCH_ASSOC)): ?>
                            <div class="task-item">
                                <div class="task-info">
                                    <h4><?php echo htmlspecialchars($task['titre']); ?></h4>
                                    <span class="deadline-countdown">
                                        Échéance: <?php echo formatDate($task['date_echeance']); ?>
                                    </span>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>Aucune tâche à venir</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</div>

<?php require_once "includes/footer.php"; ?>