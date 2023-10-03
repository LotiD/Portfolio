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
   
    <title>Admin - CV</title>
</head>
<body>

    
    <?php require_once('../ressources/includes/header.php'); ?>
    <div id="main" class="wrapper style1">
        <div class="container">
            <header class="major">
                <h2>Slogan ou Accroche de la page CV</h2>
            </header>    

            <div class="wrapper">
                <?php 
                try {
                    $sql = "SELECT * FROM cv";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    if(count($result) > 0){
                        echo '<table class="alt">';
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>#</th>";
                                    echo "<th>Slogan</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            foreach($result as $row){
                                echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['slogan'] . "</td>";
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
                <h2>Gestionnaire des formations</h2>
            </header>    

            <div class="wrapper">
                <div>    
                    <a href="creation_formations.php" class="button"><i class="bi bi-plus"></i> Ajouter</a>
                </div>
                <?php 
                try {
                    $sql2 = "SELECT * FROM formations";
                    $stmt = $conn->prepare($sql2);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    if(count($result) > 0){
                        echo '<table class="alt">';
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>#</th>";
                                    echo "<th>Nom de la formation</th>";
                                    echo "<th>Année de début</th>";
                                    echo "<th>Année de fin</th>";
                                    echo "<th>Description</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            foreach($result as $row){
                                echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['nom'] . "</td>";
                                    echo "<td>" . $row['annee_debut'] . "</td>";
                                    echo "<td>" . $row['annee_fin'] . "</td>";
                                    echo "<td>" . $row['description'] . "</td>";
                                    echo "<td>";
                                        echo '<a href="modif_formations.php?id='. $row['id'] .'" class="me-3" ><span class="bi bi-pencil"></span></a>';
                                        echo '<a href="suppr_formations.php?id='. $row['id'] .'" ><span class="bi bi-trash"></span></a>';
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
                <h2>Gestionnaire des compétences</h2>
            </header>    

            <div class="wrapper">
                <div>    
                    <a href="creation_skills.php" class="button"><i class="bi bi-plus"></i> Ajouter</a>
                </div>
                <?php 
                try {
                    $sql3 = "SELECT * FROM skills";
                    $stmt = $conn->prepare($sql3);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    if(count($result) > 0){
                        echo '<table class="alt">';
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>#</th>";
                                    echo "<th>Nom de la compétence</th>";
                                    echo "<th>Description</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            foreach($result as $row){
                                echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['titre'] . "</td>";
                                    echo "<td>" . $row['description'] . "</td>";
                                    echo "<td>";
                                        echo '<a href="modif_skills.php?id='. $row['id'] .'" class="me-3" ><span class="bi bi-pencil"></span></a>';
                                        echo '<a href="suppr_skills.php?id='. $row['id'] .'" ><span class="bi bi-trash"></span></a>';
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
<!-- JavaScript Bundle with Popper.js 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-2TH1gVI6Dqpn6UTMc32r1fzlGjc5hc5RT5+VMwUOkHauI6Q/eU6kq3rTGbNU6rXr" crossorigin="anonymous"></script>
-->
