<?php
session_start();

// Connexion à la base de données
require_once('../../includes/connexion-bdd.php');

// Initialiser les variables
$titre = $description = "";
$titre_err = $description_err = "";

// Vérifier si le formulaire a été soumis (méthode POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // Récupérer et nettoyer les données soumises dans le formulaire
    $input_titre = trim($_POST["titre"]);

    // Valider que le champ titre n'est pas vide
    if (empty($input_titre)) {
        $titre_err = "Veillez entrez un titre pour votre projet.";
    } 
    // Si le titre est valide, le sauvegarder dans la variable $titre
    else {
        $titre = $input_titre;
    }

    // Récupérer et nettoyer les données soumises dans le formulaire
    $input_description = trim($_POST["description"]);

    // Valider que le champ description n'est pas vide
    if (empty($input_description)) {
        $description_err = "Veillez entrez une description pour votre projet.";     
    } 
    // Si le champ description n'est pas vide, le sauvegarder dans la variable $description
    else {
        $description = $input_description;
    }


    // Si toutes les validations sont correctes, insérer les données dans la base de données
    if (empty($titre_err) && empty($description_err)) {
            try {


                // Préparer la requête SQL d'insertion
                $sql = "INSERT INTO skills (titre, description) VALUES (:titre, :description)";
                $stmt = $conn->prepare($sql);

                // Lier les paramètres de la requête SQL avec les variables PHP correspondantes
                $stmt->bindParam(":titre", $titre, PDO::PARAM_STR);
                $stmt->bindParam(":description", $description, PDO::PARAM_STR);

                // Exécuter la requête SQL
                if ($stmt->execute()) {
                    echo "L'insertion a réussi.";
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


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .wrapper{
            width: 700px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Créer un enregistrement</h2>
                    <p>Remplir le formulaire pour enregistrer le projet dans la base de données</p>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nom de la compétence</label>
                            <input type="text" name="titre" class="form-control <?php echo (!empty($titre_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $titre; ?>">
                            <span class="invalid-feedback"><?php echo $titre_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea type="text" name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $description; ?>"></textarea>
                            <span class="invalid-feedback"><?php echo $description_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="cv_admin.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>





