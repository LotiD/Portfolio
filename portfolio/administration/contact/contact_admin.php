<?php
    session_start();
    require_once('../../includes/connexion-bdd.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/main.css" />
    <link rel="stylesheet" href="../ressources/css/style.css" />
    <noscript><link rel="stylesheet" href="../../assets/css/noscript.css" /></noscript>
    <script src="../../assets/js/jquery.min.js"></script>
        <script src="../../assets/js/jquery.scrolly.min.js" defer></script>
        <script src="../../assets/js/jquery.dropotron.min.js" defer></script>
        <script src="../../assets/js/jquery.scrollex.min.js" defer></script>
        <script src="../../assets/js/browser.min.js" defer></script>
        <script src="../../assets/js/breakpoints.min.js" defer></script>
        <script src="../../assets/js/util.js" defer></script>
        <script src="../../assets/js/main.js" defer></script>
   
    <title>Admin - Contact</title>
</head>
<body>

    
    <?php require_once('../ressources/includes/header.php'); ?>
    <div id="main" class="wrapper style1">
        <div class="container">
            <header class="major">
                <h2>Accroche de la page contact</h2>
            </header>    

            <div class="wrapper">
                <?php 
                try {
                    $sql = "SELECT * FROM contact";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    if(count($result) > 0){
                        echo '<table class="alt">';
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>#</th>";
                                    echo "<th>Accroche</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            foreach($result as $row){
                                echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['accroche'] . "</td>";
                                    echo "<td>";
                                        echo '<a href="update.php?id='. $row['id'] .'" class="me-3" ><span class="bi bi-pencil"></span></a>';
                                    echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";                            
                        echo "</table>";
                    } else{
                        echo '<div class="alert alert-danger"><em>Pas d\'enregistrement trouvé.</em></div>';
                    }
                } catch(PDOException $e) {
                    die("ERREUR: Impossible d'exécuter la requête $sql. " . $e->getMessage());
                    }
                ?>
            </div>
        </div>

        <div class="container">
            <header class="major">
                <h2>Gestionnaire des projets</h2>
            </header>    

            <div class="wrapper">
                <div>    
                    <a href="creation_projets.php" class="button"><i class="bi bi-plus"></i> Ajouter</a>
                </div>
                <?php 
                try {
                    $sql2 = "SELECT * FROM message";
                    $stmt = $conn->prepare($sql2);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    if(count($result) > 0){
                        echo '<table class="alt">';
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>#</th>";
                                    echo "<th>Nom</th>";
                                    echo "<th>Prenom</th>";
                                    echo "<th>Email</th>";
                                    echo "<th>Contenu</th>";
                                    echo "<th>Type</th>";
                                    echo "<th>Date du message</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            foreach($result as $row){
                                echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['nom'] . "</td>";
                                    echo "<td>" . $row['prenom'] . "</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo "<td>" . $row['contenu'] . "</td>";
                                    echo "<td>" . $row['type'] . "</td>";
                                    echo "<td>" . $row['date_creation'] . "</td>";
                                    echo "<td>";
                                        echo '<a href="suppr_message.php?id='. $row['id'] .'" ><span class="bi bi-trash"></span></a>';
                                    echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";                            
                        echo "</table>";
                    } else{
                        echo '<div class="alert alert-danger"><em>Pas d\'enregistrement trouvé.</em></div>';
                    }
                } catch(PDOException $e) {
                    die("ERREUR: Impossible d'exécuter la requête $sql. " . $e->getMessage());
                    }
                                    /* Close connection */
                unset($conn);
                ?>
            </div>
        </div>
        
        
    </div>
<body>
<html>