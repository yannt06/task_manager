<nav class="nav-bar">
    <div class="nav-container">
        <a href="index.php" class="nav-logo"><?php echo SITE_NAME; ?></a>
        <div class="nav-menu">
            <?php if (Session::isLoggedIn()): ?>
                <span class="nav-user">
                    <?php echo htmlspecialchars(Session::get('user_nom')); ?>
                </span>
                <a href="logout.php" class="nav-link">Déconnexion</a>
            <?php endif; ?>
        </div>
    </div>
</nav>