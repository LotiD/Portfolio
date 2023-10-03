<?php
session_start();

// Connexion à la base de données
require_once('../../includes/connexion-bdd.php');

// Initialiser les variables
$nom = $annee_debut = $annee_fin = $description = "";
$nom_err = $annee_debut_err = $annee_fin_err = $description_err = "";

// Vérifier si le formulaire a été soumis (méthode POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // Récupérer et nettoyer les données soumises dans le formulaire
    $input_nom = trim($_POST["nom"]);

    // Valider que le champ nom n'est pas vide
    if (empty($input_nom)) {
        $nom_err = "Veillez entrez un nom pour votre projet.";
    } 
    // Si le nom est valide, le sauvegarder dans la variable $nom
    else {
        $nom = $input_nom;
    }

    // Validation annee debut
    $input_annee_debut = trim($_POST["annee_debut"]);
    if(empty($input_annee_debut)){
        $annee_debut_err = "Veuillez entrer une annee_debut.";
    } 
    else{
        $annee_debut = $input_annee_debut; // mettre à jour la variable $annne_debut avec la valeur entrée
    }

    //Validation annee fin
    $input_annee_fin = trim($_POST["annee_fin"]);
    if(empty($input_annee_fin)){
        $annee_fin_err = "Veuillez entrer une annee_fin.";
    } 
    else{
        $annee_fin = $input_annee_fin; // mettre à jour la variable $annne_fin avec la valeur entrée
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
    if (empty($nom_err) && empty($annee_debut_err) && empty($annee_fin_err) && empty($description_err)) {
            try {


                // Préparer la requête SQL d'insertion
                $sql = "INSERT INTO formations (nom, annee_debut, annee_fin, description) VALUES (:nom, :annee_debut, :annee_fin, :description)";
                $stmt = $conn->prepare($sql);

                // Lier les paramètres de la requête SQL avec les variables PHP correspondantes
                $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
                $stmt->bindParam(":annee_debut", $annee_debut, PDO::PARAM_STR);
                $stmt->bindParam(":annee_fin", $annee_fin, PDO::PARAM_INT);
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
                            <label>Nom de la formation</label>
                            <input type="text" name="nom" class="form-control <?php echo (!empty($nom_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nom; ?>">
                            <span class="invalid-feedback"><?php echo $nom_err;?></span>
                        </div>
                        
                        <div class="form-group">
                            <label>Année de debut</label>
                            <input type="text" name="annee_debut" class="form-control <?php echo (!empty($annee_debut_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $annee_debut; ?>">
                            <span class="invalid-feedback"><?php echo $annee_debut_err;?></span>
                        </div>

                        
                        <div class="form-group">
                            <label>Annee de fin</label>
                            <input type="text" name="annee_fin" class="form-control <?php echo (!empty($annee_fin_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $annee_fin; ?>">
                            <span class="invalid-feedback"><?php echo $annee_fin_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $description; ?>">
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





