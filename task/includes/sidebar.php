<?php
$currentPage = basename($_SERVER['PHP_SELF'], '.php');
?>
<aside class="sidebar">
    <div class="sidebar-logo">
        <i class="fas fa-tasks"></i>
        <span><?php echo SITE_NAME; ?></span>
    </div>
    
    <nav class="sidebar-menu">
        <a href="dashboard.php" class="sidebar-link <?php echo $currentPage === 'dashboard' ? 'active' : ''; ?>">
            <i class="fas fa-home"></i>
            <span>Tableau de bord</span>
        </a>
        <a href="index.php" class="sidebar-link <?php echo $currentPage === 'index' ? 'active' : ''; ?>">
            <i class="fas fa-tasks"></i>
            <span>Mes tâches</span>
        </a>
        <a href="create.php" class="sidebar-link <?php echo $currentPage === 'create' ? 'active' : ''; ?>">
            <i class="fas fa-plus"></i>
            <span>Nouvelle tâche</span>
        </a>
        <a href="profile.php" class="sidebar-link <?php echo $currentPage === 'profile' ? 'active' : ''; ?>">
            <i class="fas fa-user"></i>
            <span>Mon profil</span>
        </a>
        <a href="logout.php" class="sidebar-link">
            <i class="fas fa-sign-out-alt"></i>
            <span>Déconnexion</span>
        </a>
    </nav>
</aside>