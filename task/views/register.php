<?php 
$pageTitle = "Inscription";
require_once "includes/header.php"; 
?>

<div class="auth-page">
    <div class="auth-container">
        <div class="auth-logo">
            <i class="fas fa-tasks"></i>
            <h1><?php echo SITE_NAME; ?></h1>
        </div>
        
        <div class="auth-card">
            <div class="auth-header">
                <h2>Inscription</h2>
                <p>Créez votre compte pour commencer</p>
            </div>

            <?php if (isset($error)): ?>
                <div class="alert error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="register.php" class="auth-form">
                <div class="form-group">
                    <label for="nom">
                        <i class="fas fa-user"></i>
                        Nom
                    </label>
                    <input type="text" id="nom" name="nom" class="form-control" 
                           value="<?php echo isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : ''; ?>" 
                           required>
                </div>

                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i>
                        Email
                    </label>
                    <input type="email" id="email" name="email" class="form-control"
                           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" 
                           required>
                </div>

                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock"></i>
                        Mot de passe
                    </label>
                    <div class="password-input">
                        <input type="password" id="password" name="password" class="form-control" required>
                        <button type="button" class="toggle-password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-user-plus"></i>
                    S'inscrire
                </button>
            </form>

            <div class="auth-footer">
                <p>Déjà inscrit ?</p>
                <a href="login.php" class="btn btn-outline btn-block">
                    <i class="fas fa-sign-in-alt"></i>
                    Se connecter
                </a>
            </div>
        </div>
    </div>
</div>

<?php require_once "includes/footer.php"; ?>