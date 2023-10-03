<?php // Connexion à la base de données
require_once('../../includes/connexion-bdd.php');

// Initialiser les variables
$nom_projet = $description = "";
$nom_projet_err = $description_err = "";

// Vérifier si le formulaire a été soumis (méthode POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupération de l'identifiant du projet à modifier
    $id_projet = $_POST['id'];

    // Récupération du nom du fichier
    $filename = basename($_FILES["file"]["name"]);

    // Définition de l'emplacement de stockage du fichier
    $target_dir = "uploads/";
    $target_file = $target_dir . $filename;

    // Vérification que le fichier est au format JPG
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if ($imageFileType != "jpg") {
        echo "Seuls les fichiers JPG sont autorisés.";
        exit;
    }

    // Récupérer et nettoyer les données soumises dans le formulaire
    $input_nom_projet = trim($_POST["nom_projet"]);

    // Valider que le champ nom n'est pas vide
    if (empty($input_nom_projet)) {
        $nom_projet_err = "Veillez entrez un nom pour votre projet.";
    }
    // Si le nom est valide, le sauvegarder dans la variable $nom
    else {
        $nom_projet = $input_nom_projet;
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

    // Vérifier si toutes les validations sont correctes avant d'effectuer la mise à jour
    if (empty($nom_projet_err) && empty($description_err)) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            try {
                // Préparer la requête SQL de mise à jour
                $sql = "UPDATE projets SET nom_projet = :nom_projet, description = :description, image = :image WHERE id = :id";
                $stmt = $conn->prepare($sql);

                // Lier les paramètres de la requête SQL avec les variables PHP correspondantes
                $stmt->bindParam(":nom_projet", $nom_projet, PDO::PARAM_STR);
                $stmt->bindParam(":description", $description, PDO::PARAM_STR);
                $stmt->bindParam(':image', $target_file);
                $stmt->bindParam(':id', $id_projet);

                // Exécuter la requête SQL
                if ($stmt->execute()) {
                    echo "La mise à jour a réussi.";
                    header("location: portfolio_admin.php");
                    exit();
                } else {
                    echo "Oops! une erreur est survenue.";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }    
    }
}






if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    $id_projet = trim($_GET["id"]);

    // Préparation de la requête SQL pour la sélection de l'enregistrement avec l'ID spécifié
    $sql = "SELECT * FROM projets WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Bind des paramètres pour la sélection
    $stmt->bindParam(1, $id_projet);

    // Exécution de la requête de sélection
    if($stmt->execute()){
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result){
            // Récupère l'enregistrement
            $nom_projet = $result["nom_projet"] ;
            $description = $result["description"];
            $target_file = $result["image"];
            
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $id_projet; ?>">
        <div>
            <label for="nom_projet">Nom du projet :</label>
            <input type="text" id="nom_projet" name="nom_projet" value="<?php echo $nom_projet; ?>">
        </div>
        <div>
            <label for="description">Description :</label>
            <textarea id="description" name="description"><?php echo $description; ?></textarea>
        </div>
        <div>
            <label for="file">Image :</label>
            <input type="file" id="file" name="file">
        </div>
        <div>
            <input type="submit" value="Enregistrer">
        </div>
    </form>
</body>
</html>