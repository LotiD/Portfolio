<?php
session_start();

try {
    require_once('../../includes/connexion-bdd.php');

    $result = $conn->query("SELECT * FROM accueil");
    $result = $result->fetch();

    // Définir les variables
    $nom = $result ['nom'] ;
    $prenom = $result ['prenom'] ;
    $accroche = $result ['accroche'] ;
    $description = $result ['description'] ;
    $apercu_titre_1 = $result ['apercu_titre_1'] ;
    $apercu_accroche_1 = $result ['apercu_accroche_1'] ;
    $apercu_description_1 = $result ['apercu_description_1'] ;
    $apercu_titre_2 = $result ['apercu_titre_2'] ;
    $apercu_accroche_2 = $result ['apercu_accroche_2'] ;
    $apercu_description_2 = $result ['apercu_description_2'] ;

    // Initialiser les variables d'erreurs
    $nom_err = "";
    $prenom_err = "";
    $accroche_err = "";
    $description_err = "";
    $apercu_titre_1_err = "";
    $apercu_accroche_1_err = "";
    $apercu_description_1_err = "";
    $apercu_titre_2_err = "";
    $apercu_accroche_2_err = "";
    $apercu_description_2_err = "";

    // Initialiser les variables qui stockeront les valeurs d'entrées du formulaire
    $input_nom = "";
    $input_prenom = "";
    $input_accroche = "";
    $input_description = "";
    $input_apercu_titre_1 = "";
    $input_apercu_accroche_1 = "";
    $input_apercu_description_1 = "";
    $input_apercu_titre_2 = "";
    $input_apercu_accroche_2 = "";
    $input_apercu_description_2 = "";

    // Vérifier la valeur id dans le post pour la mise à jour
    if(isset($_POST["id"]) && !empty($_POST["id"])){
        $id = $_POST["id"];

        //Validation du nom
        $input_nom = trim($_POST["nom"]);
        if(empty($input_nom)){
            $nom_err = "Veuillez entrer un nom.";
        } 
        else{
            $nom = $input_nom; // mettre à jour la variable $nom avec la valeur entrée
        }

        //Validation du prénom
        $input_prenom = trim($_POST["prenom"]);
        if(empty($input_prenom)){
            $prenom_err = "Veuillez entrer une prenom.";
        } 
        else{
            $prenom = $input_prenom; // mettre à jour la variable $prenom avec la valeur entrée
        }
    
        // Validation de l'accroche
        $input_accroche = trim($_POST["accroche"]);
        if(empty($input_accroche)){
            $accroche_err = "Veuillez entrer une accroche.";
        } 
        else{
            $accroche = $input_accroche; // mettre à jour la variable $accroche avec la valeur entrée
        }
    
        //Validation de la description
        $input_description = trim($_POST["description"]);
        if(empty($input_description)){
            $description_err = "Veuillez entrer une description.";
        } 
        else{
            $description = $input_description; // mettre à jour la variable $accroche avec la valeur entrée
        }

        //Validation de l'apercu titre 1
        $input_apercu_titre_1 = trim($_POST["apercu_titre_1"]);
        if(empty($input_apercu_titre_1)){
            $apercu_titre_1_err = "Veuillez entrer un apercu_titre_1.";
        } 
        else{
            $apercu_titre_1 = $input_apercu_titre_1; // mettre à jour la variable $input_apercu_titre_1 avec la valeur entrée
        }

        //Validation de l'apercu accroche 1
        $input_apercu_accroche_1 = trim($_POST["apercu_accroche_1"]);
        if(empty($input_apercu_accroche_1)){
            $apercu_accroche_1_err = "Veuillez entrer un apercu_accroche_1.";
        } 
        else{
            $apercu_accroche_1 = $input_apercu_accroche_1; // mettre à jour la variable $apercu_accroche_1 avec la valeur entrée
        }

        //Validation de l'apercu description 1
        $input_apercu_description_1 = trim($_POST["apercu_description_1"]);
        if(empty($input_apercu_description_1)){
            $apercu_description_1_err = "Veuillez entrer une apercu_description_1.";
        } 
        else{
            $apercu_description_1 = $input_apercu_description_1; // mettre à jour la variable $apercu_description_1 avec la valeur entrée
        }

        //Validation de l'apercu titre 2
        $input_apercu_titre_2 = trim($_POST["apercu_titre_2"]);
        if(empty($input_apercu_titre_2)){
            $apercu_titre_2_err = "Veuillez entrer un apercu_titre_2.";
        } 
        else{
            $apercu_titre_2 = $input_apercu_titre_2; // mettre à jour la variable $apercu_titre_2 avec la valeur entrée
        }

        //Validation de l'apercu accroche 2
        $input_apercu_accroche_2 = trim($_POST["apercu_accroche_2"]);
        if(empty($input_apercu_accroche_2)){
            $apercu_accroche_2_err = "Veuillez entrer un apercu_accroche_2.";
        } 
        else{
            $apercu_accroche_2 = $input_apercu_accroche_2; // mettre à jour la variable $apercu_accroche_2 avec la valeur entrée
        }

        //Validation de l'apercu description 2
        $input_apercu_description_2 = trim($_POST["apercu_description_2"]);
        if(empty($input_apercu_description_2)){
            $apercu_description_2_err = "Veuillez entrer une apercu_description_2.";
        } 
        else{
            $apercu_description_2 = $input_apercu_description_2; // mettre à jour la variable $apercu_description_2 avec la valeur entrée
        }

        // Vérifier les erreurs avant modification

        if( empty($nom_err) && empty($prenom_err) && empty($accroche_err) && empty($description_err)  && empty($apercu_titre_1_err) && empty($apercu_accroche_1_err) && empty($apercu_description_1_err) && empty($apercu_titre_2_err) && empty($apercu_accroche_2_err) && empty($apercu_description_2_err)){

            // Préparation de la requête SQL pour la mise à jour de l'enregistrement avec l'ID spécifié
            $sql = "UPDATE accueil SET nom = :nom, prenom = :prenom, accroche = :accroche, description = :description, apercu_titre_1 = :apercu_titre_1, apercu_accroche_1 = :apercu_accroche_1, apercu_description_1 = :apercu_description_1, apercu_titre_2 = :apercu_titre_2, apercu_accroche_2 = :apercu_accroche_2, apercu_description_2 = :apercu_description_2  WHERE id=:id";
            $stmt = $conn->prepare($sql);

            // Bind des paramètres pour la mise à jour
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
            $stmt->bindParam(":prenom", $prenom, PDO::PARAM_STR);
            $stmt->bindParam(":accroche", $accroche, PDO::PARAM_STR);
            $stmt->bindParam(":description", $description, PDO::PARAM_STR);
            $stmt->bindParam(":apercu_titre_1", $apercu_titre_1, PDO::PARAM_STR);
            $stmt->bindParam(":apercu_accroche_1", $apercu_accroche_1, PDO::PARAM_STR);
            $stmt->bindParam(":apercu_description_1", $apercu_description_1, PDO::PARAM_STR);
            $stmt->bindParam(":apercu_titre_2", $apercu_titre_2, PDO::PARAM_STR);
            $stmt->bindParam(":apercu_accroche_2", $apercu_accroche_2, PDO::PARAM_STR);
            $stmt->bindParam(":apercu_description_2", $apercu_description_2, PDO::PARAM_STR);
            
            // Exécution de la requête pour la mise à jour
            if($stmt->execute()){
                // Enregistrement modifié, retourner à la page d'accueil
                header("location: accueil_admin.php");
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
        $sql = "SELECT * FROM accueil WHERE id = ?";
        $stmt = $conn->prepare($sql);

        // Bind des paramètres pour la sélection
        $stmt->bindParam(1, $id);

        // Exécution de la requête de sélection
        if($stmt->execute()){
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if($result){
                // Récupère l'enregistrement
                $nom = $result ['nom'] ;
                $prenom = $result ['prenom'] ;
                $accroche = $result ['accroche'] ;
                $description = $result ['description'] ;
                $apercu_titre_1 = $result ['apercu_titre_1'] ;
                $apercu_accroche_1 = $result ['apercu_accroche_1'] ;
                $apercu_description_1 = $result ['apercu_description_1'] ;
                $apercu_titre_2 = $result ['apercu_titre_2'] ;
                $apercu_accroche_2 = $result ['apercu_accroche_2'] ;
                $apercu_description_2 = $result ['apercu_description_2'] ;
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
}

catch(PDOException $e){
    echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
}
// HTML pour le formulaire de modification

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'enregistrement</title>
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
                            <label>prenom</label>
                            <input type="text" name="prenom" class="form-control <?php echo (!empty($prenom_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $prenom; ?>">
                            <span class="invalid-feedback"><?php echo $prenom_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Accroche</label>
                            <input type="text" name="accroche" class="form-control <?php echo (!empty($accroche_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $accroche; ?>">
                            <span class="invalid-feedback"><?php echo $accroche_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>description</label>
                            <input type="text" name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $description; ?>">
                            <span class="invalid-feedback"><?php echo $description_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Apercu Titre 1</label>
                            <input type="text" name="apercu_titre_1" class="form-control <?php echo (!empty($apercu_titre_1_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $apercu_titre_1; ?>">
                            <span class="invalid-feedback"><?php echo $apercu_titre_1_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Apercu Accroche 1</label>
                            <input type="text" name="apercu_accroche_1" class="form-control <?php echo (!empty($apercu_accroche_1_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $apercu_accroche_1; ?>">
                            <span class="invalid-feedback"><?php echo $apercu_accroche_1_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Apercu Description 1</label>
                            <textarea name="apercu_description_1" class="form-control <?php echo (!empty($apercu_description_1_err)) ? 'is-invalid' : ''; ?>"><?php echo $apercu_description_1; ?></textarea>
                            <span class="invalid-feedback"><?php echo $apercu_description_1_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Apercu Titre 2</label>
                            <input type="text" name="apercu_titre_2" class="form-control <?php echo (!empty($apercu_titre_2_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $apercu_titre_2; ?>">
                            <span class="invalid-feedback"><?php echo $apercu_titre_2_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Apercu Accroche 2</label>
                            <input type="text" name="apercu_accroche_2" class="form-control <?php echo (!empty($apercu_accroche_2_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $apercu_accroche_2; ?>">
                            <span class="invalid-feedback"><?php echo $apercu_accroche_2_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Apercu Description 2</label>
                            <textarea name="apercu_description_2" class="form-control <?php echo (!empty($apercu_description_2_err)) ? 'is-invalid' : ''; ?>"><?php echo $apercu_description_2; ?></textarea>
                            <span class="invalid-feedback"><?php echo $apercu_description_2_err;?></span>
                        </div>

                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <div class = "form-group">
                            <input type="submit" class="btn btn-primary" value="Enregistrer">
                            <a href="index.php" class="btn btn-secondary ml-2">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>