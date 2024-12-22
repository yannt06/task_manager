<?php 
$pageTitle = "Nouvelle tâche";
require_once "includes/header.php";
?>

<div class="dashboard-container">
    <?php require_once "includes/sidebar.php"; ?>
    
    <main class="main-content">
        <div class="content-header">
            <h1>Nouvelle tâche</h1>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert error">
                <i class="fas fa-exclamation-circle"></i>
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <div class="task-form-container">
            <form method="POST" action="create.php" class="task-form">
                <div class="form-group">
                    <label for="titre">Titre</label>
                    <input type="text" id="titre" name="titre" class="form-control" required
                           value="<?php echo isset($_POST['titre']) ? htmlspecialchars($_POST['titre']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control" rows="4" required><?php 
                        echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; 
                    ?></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="date_debut">Date de début</label>
                        <input type="date" id="date_debut" name="date_debut" class="form-control" required
                               value="<?php echo isset($_POST['date_debut']) ? htmlspecialchars($_POST['date_debut']) : ''; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="heure_debut">Heure de début</label>
                        <input type="time" id="heure_debut" name="heure_debut" class="form-control" required
                               value="<?php echo isset($_POST['heure_debut']) ? htmlspecialchars($_POST['heure_debut']) : ''; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="date_echeance">Date de fin</label>
                        <input type="date" id="date_echeance" name="date_echeance" class="form-control" required
                               value="<?php echo isset($_POST['date_echeance']) ? htmlspecialchars($_POST['date_echeance']) : ''; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="heure_echeance">Heure de fin</label>
                        <input type="time" id="heure_echeance" name="heure_echeance" class="form-control" required
                               value="<?php echo isset($_POST['heure_echeance']) ? htmlspecialchars($_POST['heure_echeance']) : ''; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="id_categorie">Catégorie</label>
                    <select id="id_categorie" name="id_categorie" class="form-control" required>
                        <option value="">Sélectionner une catégorie</option>
                        <?php while ($categorie = $categories->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value="<?php echo $categorie['id']; ?>"
                                    <?php echo (isset($_POST['id_categorie']) && $_POST['id_categorie'] == $categorie['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($categorie['nom_categorie']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                    <a href="index.php" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </main>
</div>

<?php require_once "includes/footer.php"; ?>