<?php
session_start();

/* Confirmer */
if(isset($_POST["id"]) && !empty($_POST["id"])){
    /* Inclure le fichier connexion */
    require_once('../../includes/connexion-bdd.php');
    
    $sql = "DELETE FROM formations WHERE id = :id";
    
    if($stmt = $conn->prepare($sql)){
        $stmt->bindParam(":id", $param_id, PDO::PARAM_INT);
        
        $param_id = trim($_POST["id"]);
        
        if($stmt->execute()){
            /* Supprimé, retourne */
            header("location: cv_admin.php");
            exit();
        } else{
            echo "Oops! Une erreur est survenue.";
        }
    }
     
    $stmt = null;
    $pdo = null;
} else{
    /* Vérifier si paramètre id existe */
    if(empty(trim($_GET["id"]))){
        header("location: error.php");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer l'enregistrement</title>
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
                    <h2 class="mt-5 mb-3">Supprimer la formation</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Etes-vous sûr de vouloir supprimer cette formation ?</p>
                            <p>
                                <input type="submit" value="OUI" class="btn btn-danger">
                                <a href="cv_admin.php" class="btn btn-secondary">NON</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
