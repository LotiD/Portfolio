<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./ressources/css/style_login.css">
    <script defer src="script.js"></script>

    <title>Espace de connexion admin</title>
</head>
<body>
    <section>

<!--Si le bouton 'se connecter' est actionné et si le pseudo et le mdp saisi par l'utilisateur
est correct alors un message de succès apparaîtra

Si le bouton 'se connecter' est actionné mais que le pseudo ou/et le mdp ne sont pas saisis, 
ou que le pseudo et/ou mdp saisis sont incorrect alors un message d'erreur apparaitra-->
<?php 
if(isset($_POST['connecter'])){ 
    if (!empty($_POST['pseudo']) AND !empty($_POST['mdp'])){
        $pseudo_correct = "admin"; // Le pseudo qu'il faut rentrer
        $mdp_correct = "1234"; //Le mdp qu'il faut rentrer

        $pseudo_saisi = htmlspecialchars($_POST['pseudo']); // On empêche l'utilisateur de saisir du code HTML dans le formulaire
        $mdp_saisi = htmlspecialchars($_POST['mdp']);

        if($pseudo_saisi == $pseudo_correct AND $mdp_saisi == $mdp_correct){
            session_start();
            $_SESSION['username'] = $pseudo_correct;

            header('Location: ./accueil/accueil_admin.php');
            // or die();
             
            exit();

        }
        
        else{
            echo "
                <section class='banniere-alerte erreur banniere' role='alert' aria-live='polite' data-banniere>

                    <p>Votre mot de passe ou pseudo est incorrect.</p>

                    <button data-fermeture-banniere=''>Fermer</button>
                
                </section>
            ";
        }
    }
    else {
        echo "
            <section class='banniere-alerte erreur banniere' role='alert' aria-live='polite' data-banniere>

                <p>Veuillez compléter tous les champs.</p>

                <button data-fermeture-banniere=''>Fermer</button>
            
            </section>    
        ";
    }
}
?>      
<!--Formulaire pour se connecter-->
        <main>
            <section class="section-formulaire">
                
                <form method="POST" action="">
                    <div>
                        <article>
                            <label for="pseudo">Pseudo</label>
                            <input type="text" name="pseudo" autocomplete="off" >
                        </article>

                        <article>
                            <label for="mdp">Mot de passe</label>
                            <input type="password"name="mdp">
                        </article>
                    </div>
                    <div>
                        <button type="submit" name="connecter" class="bouton-connecter">Se connecter</button>
                    </div>    
                </form>
                
            </section>
        </main>    
    </section>
</body>
</html>