<?php
session_start();

require_once('../../includes/connexion-bdd.php');

$result = $conn->query("SELECT * FROM formations");
$result = $result->fetchAll();

// Définir les variables
//$nom = $result["nom"] ;
//$annee_debut = $result["annee_debut"] ;
//$annee_fin = $result["annee_fin"] ;
//$description = $result["description"] ;

$nom_err = $annee_debut_err = $annee_fin_err = $description_err = "";

$input_nom = "";
$input_annee_debut = "";
$input_annee_fin = "";
$input_description = "";

// Vérifier la valeur id dans le post pour la mise à jour
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];

    // Validation du nom
    $input_nom = trim($_POST["nom"]);
    if(empty($input_nom)){
        $nom_err = "Veuillez entrer un nom.";
    } 
    else{
        $nom = $input_nom; // mettre à jour la variable $nom avec la valeur entrée
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

    //Validation de la description
    $input_description = trim($_POST["description"]);
    if(empty($input_description)){
        $description_err = "Veuillez entrer une description.";
    } 
    else{
        $description = $input_description; // mettre à jour la variable $description avec la valeur entrée
    }

    // Vérifier les erreurs avant modification
    if(empty($nom_err && empty($annee_debut_err) && empty($annee_fin_err) && empty($description_err))){

        // Préparation de la requête SQL pour la mise à jour de l'enregistrement avec l'ID spécifié
        $sql = "UPDATE formations SET nom = :nom, annee_debut = :annee_debut, annee_fin = :annee_fin, description = :description WHERE id=:id";
        $stmt = $conn->prepare($sql);

        // Bind des paramètres pour la mise à jour
        $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
        $stmt->bindParam(":annee_debut", $annee_debut, PDO::PARAM_INT);
        $stmt->bindParam(":annee_fin", $annee_fin, PDO::PARAM_INT);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT); // liaison du paramètre pour l'ID

        // Exécution de la requête pour la mise à jour
        if($stmt->execute()){
            // Enregistrement modifié, retourner à la page d'accueil
            header("location: cv_admin.php");
            exit();
        } else{
            echo "Oops! une erreur est survenue.";
        }
    } 

} // fin du bloc "if(isset($_POST["id"]) && !empty($_POST["id"]))"

// Si un paramètre id existe dans l'URL
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    $id = trim($_GET["id"]);

    // Préparation de la requête SQL pour la sélection de l'enregistrement avec l'ID spécifié
    $sql = "SELECT * FROM formations WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Bind des paramètres pour la sélection
    $stmt->bindParam(1, $id);

    // Exécution de la requête de sélection
    if($stmt->execute()){
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result){
            // Récupère l'enregistrement
            $nom = $result["nom"];
            $annee_debut = $result["annee_debut"] ;
            $annee_fin = $result["annee_fin"] ;
            $description = $result["description"] ;
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

    // Fermeture du statement et de la connexion
    $stmt = null;
    $conn = null;

} // fin du bloc "if(isset($_GET["id"]) && !empty(trim($_GET["id"])))"

else{
    // Si le paramètre id n'est pas spécifié dans l'URL
    header("location: error.php");
    exit();
}

// HTML pour le formulaire de modification

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'enregistremnt</title>
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
                    <h2 class="mt-5">Mise à jour de l'enregistremnt</h2>
                    <p>Modifier les champs et enregistrer</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>nom</label>
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

                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="index.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>