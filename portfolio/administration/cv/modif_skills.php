<?php
session_start();

// Connexion à la base de données
require_once('../../includes/connexion-bdd.php');

// Vérifier la valeur id dans le post pour la mise à jour
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];

    // Récupérer et nettoyer les données soumises dans le formulaire
    $titre = trim($_POST["titre"]);
    $description = trim($_POST["description"]);

    // Initialiser les variables d'erreur
    $titre_err = $description_err = "";

    // Valider que le champ titre n'est pas vide
    if (empty($titre)) {
        $titre_err = "Veillez entrez un titre pour votre compétence.";
    } 

    // Valider que le champ description n'est pas vide
    if (empty($description)) {
        $description_err = "Veillez entrez une description pour votre compétence.";     
    } 

    // Si toutes les validations sont correctes, insérer les données dans la base de données
    if (empty($titre_err) && empty($description_err)) {
        try {
            // Préparer la requête SQL de mise à jour
            $sql = "UPDATE skills SET titre = :titre, description = :description WHERE id= :id";
            $stmt = $conn->prepare($sql);

            // Lier les paramètres de la requête SQL avec les variables PHP correspondantes
            $stmt->bindParam(":titre", $titre, PDO::PARAM_STR);
            $stmt->bindParam(":description", $description, PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT); // liaison du paramètre pour l'ID

            // Exécuter la requête SQL
            if ($stmt->execute()) {
                // Enregistrement modifié, retourner à la page d'accueil
                header("location: cv_admin.php");
                exit();
            } 
            else {
                echo "Oops! une erreur est survenue.";
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }    
}

// Si un paramètre id existe dans l'URL
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    $id = trim($_GET["id"]);

    // Préparation de la requête SQL pour la sélection de l'enregistrement avec l'ID spécifié
    $sql = "SELECT * FROM skills WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Bind des paramètres pour la sélection
    $stmt->bindParam(1, $id);

    // Exécution de la requête de sélection
    if($stmt->execute()){
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result){
            // Récupère l'enregistrement
            $titre = $result["titre"];
            $description = $result["description"];
        } 

        else{
            // Retourne à la page d'erreur si aucun enregistrement n'a été trouvé
            header("location: error.php");
            exit();
        }

    } 

    else{
        echo "Oops! une erreur est survenue.";
    }

    // Fermeture du statement
    $stmt = null;

} // fin du bloc "if(isset($_GET["id"]) && !empty(trim($_GET["id"])))"

else{
    // Si le paramètre id
    header("location: cv_admin.php");
exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier compétence</title>
    <!-- Importation de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Modifier compétence</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Titre de la compétence :</label>
                <input type="text" class="form-control <?php echo (!empty($titre_err)) ? 'is-invalid' : ''; ?>" name="titre" value="<?php echo $titre; ?>">
                <span class="invalid-feedback"><?php echo $titre_err; ?></span>
            </div>
            <div class="form-group">
                <label>Description de la compétence :</label>
                <textarea class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>" name="description"><?php echo $description; ?></textarea>
                <span class="invalid-feedback"><?php echo $description_err; ?></span>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <button type="submit" class="btn btn-primary">Modifier</button>
            <a href="cv_admin.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>

    <!-- Importation des scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html> 
