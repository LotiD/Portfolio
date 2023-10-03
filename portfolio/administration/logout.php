<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="./ressources/css/style_logout.css" >
    <noscript><link rel="stylesheet" href="../../assets/css/noscript.css" /></noscript>
    <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/jquery.scrolly.min.js" defer></script>
        <script src="../assets/js/jquery.dropotron.min.js" defer></script>
        <script src="../assets/js/jquery.scrollex.min.js" defer></script>
        <script src="../assets/js/browser.min.js" defer></script>
        <script src="../assets/js/breakpoints.min.js" defer></script>
        <script src="../assets/js/util.js" defer></script>
        <script src="../assets/js/main.js" defer></script>
    <title>Déconnexion</title>
</head>
<body>
    <section>

        <!--Si le bouton 'se connecter' est actionné et si le pseudo et le mdp saisi par l'utilisateur
        est correct alors un message de succès apparaîtra

        Si le bouton 'se connecter' est actionné mais que le pseudo ou/et le mdp ne sont pas saisis, 
        ou que le pseudo et/ou mdp saisis sont incorrect alors un message d'erreur apparaitra-->

        <?php 
        if(isset($_POST['deconnecter'])){
            session_destroy();
            header('Location: ../index.php');
        }
        ?>      

        <main>
            <section class="section-formulaire">
                <div class="container">
                    <h2>Déconnectez-vous et revenez sur votre site</h2>

                    <form method="POST" action="">
                        <div class="row gtr-uniform gtr-50">
                            <div>
                                <button type="submit" name="deconnecter" class="button centered">Déconnecter</button>
                            </div>
                        </div>        
                    </form>
                </div> 
            </section>
        </main>    
    </section>
</body>
</html>
