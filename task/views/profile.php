<?php 
$pageTitle = "Mon profil";
require_once "includes/header.php";
?>

<div class="dashboard-container">
    <?php require_once "includes/sidebar.php"; ?>
    
    <main class="main-content">
        <div class="content-header">
            <h1>Mon profil</h1>
        </div>

        <div class="profile-container">
            <?php if (isset($userInfo)): ?>
                <div class="profile-card">
                    <div class="profile-header">
                        <i class="fas fa-user-circle profile-icon"></i>
                        <h2><?php echo htmlspecialchars($userInfo['nom']); ?></h2>
                    </div>
                    <div class="profile-info">
                        <p>
                            <strong>Email:</strong> 
                            <?php echo htmlspecialchars($userInfo['email']); ?>
                        </p>
                    </div>
                </div>
            <?php else: ?>
                <p class="error-message">Impossible de charger les informations du profil.</p>
            <?php endif; ?>
        </div>
    </main>
</div>

<?php require_once "includes/footer.php"; ?>