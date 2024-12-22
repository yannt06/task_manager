<?php 
$pageTitle = "Connexion";
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
                <h2>Connexion</h2>
                <p>Connectez-vous pour accéder à votre espace</p>
            </div>

            <?php if (isset($error)): ?>
                <div class="alert error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="login.php" class="auth-form">
                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i>
                        Email
                    </label>
                    <input type="email" id="email" name="email" 
                           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" 
                           required>
                </div>

                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock"></i>
                        Mot de passe
                    </label>
                    <div class="password-input">
                        <input type="password" id="password" name="password" required>
                        <button type="button" class="toggle-password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-sign-in-alt"></i>
                    Se connecter
                </button>
            </form>

            <div class="auth-footer">
                <p>Pas encore de compte ?</p>
                <a href="register.php" class="btn btn-outline">
                    <i class="fas fa-user-plus"></i>
                    Créer un compte
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelector('.toggle-password').addEventListener('click', function() {
    const input = document.querySelector('#password');
    const icon = this.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
});
</script>

<?php require_once "includes/footer.php"; ?>