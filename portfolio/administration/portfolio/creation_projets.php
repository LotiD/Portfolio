<?php
// Connexion à la base de données
require_once('../../includes/connexion-bdd.php');

// Initialiser les variables
$nom_projet = $description = "";
$nom_projet_err = $description_err = "";

// Vérifier si le formulaire a été soumis (méthode POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupération du nom du fichier
   $filename = basename($_FILES["file"]["name"]);

   // Définition de l'emplacement de stockage du fichier
   $target_dir = "uploads/";
   $target_file = $target_dir . $filename;

   // Vérification que le fichier est au format JPG
   $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   if($imageFileType != "jpg") {
       echo "Seuls les fichiers JPG sont autorisés.";
       exit;
   }





    // Récupérer et nettoyer les données soumises dans le formulaire
    $input_nom_projet = trim($_POST["nom_projet"]);

    // Valider que le champ nom n'est pas vide
    if (empty($input_nom_projet)) {
        $nom_err = "Veillez entrez un nom pour votre projet.";
    } 
    // Si le nom est valide, le sauvegarder dans la variable $nom
    else {
        $nom_projet = $input_nom_projet;
    }

    // Récupérer et nettoyer les données soumises dans le formulaire
    $input_description = trim($_POST["description"]);

    // Valider que le champ ecole n'est pas vide
    if (empty($input_description)) {
        $description_err = "Veillez entrez une description pour votre projet.";     
    } 
    // Si le champ ecole n'est pas vide, le sauvegarder dans la variable $ecole
    else {
        $description = $input_description;
    }


    // Si toutes les validations sont correctes, insérer les données dans la base de données
    if (empty($nom_projet_err) && empty($description_err)) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            try {


                // Préparer la requête SQL d'insertion
                $sql = "INSERT INTO projets (nom_projet, description, image) VALUES (:nom_projet, :description, :image)";
                $stmt = $conn->prepare($sql);

                // Lier les paramètres de la requête SQL avec les variables PHP correspondantes
                $stmt->bindParam(":nom_projet", $nom_projet, PDO::PARAM_STR);
                $stmt->bindParam(":description", $description, PDO::PARAM_STR);
                $stmt->bindParam(':image', $target_file);

                // Exécuter la requête SQL
                if ($stmt->execute()) {
                    echo "L'insertion a réussi.";
                    header("location: portfolio_admin.php");
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
                            <label>Nom du projet</label>
                            <input type="text" name="nom_projet" class="form-control <?php echo (!empty($nom_projet_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nom_projet; ?>">
                            <span class="invalid-feedback"><?php echo $nom_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $description; ?>">
                            <span class="invalid-feedback"><?php echo $description_err;?></span>
                        </div>
                        <div class="form-group">
                            <label for="file">Sélectionnez un fichier JPG à télécharger :</label>
                            <input type="file" name="file" id="file"><br>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="portfolio_admin.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>





