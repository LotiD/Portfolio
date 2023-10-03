<?php 
require_once('./includes/connexion-bdd.php');

$sql= 'SELECT * FROM contact';
$result = $conn->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);
$row = $result->fetch();

$formulaire_a_erreurs = false;
$formulaire_soumis = !empty($_POST);

if ($formulaire_soumis) {
    if (!empty($_POST["prenom"]) && !empty($_POST["nom"]) && !empty($_POST["message"]) && !empty($_POST["email"]) && !empty($_POST["je_suis"])) {
        
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

		// Requête pour écrire le message dans la base :
        $insertionMessageRequete = "
                INSERT INTO message(nom, prenom, contenu, email, type, date_creation) 
                VALUES (:nom, :prenom, :contenu, :email, :type, :date)
            ";

        // On prépare la requête
        $messageCommande = $conn->prepare($insertionMessageRequete);

        $nom = htmlentities($_POST["nom"]);
        $prenom = htmlentities($_POST["prenom"]);
        $message = htmlentities($_POST["message"]);
        $email = htmlentities($_POST["email"]);
        $type = htmlentities($_POST["je_suis"]);

        // On récupère la date du jour
        $date = new DateTimeImmutable();

        // On l'exécute 
        // et on remplace les placeholders de la requête par nos valeurs
        $messageCommande->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'contenu' => $message,
            'email' => $email,
            'type' => $type,
            // La date est formatée en chaîne de caractères
            // au format Année-mois-jour Heure:minutes:secondes
            // Sinon, elle ne pourra pas être 
            // insérée dans la base de données
            'date' => $date->format('Y-m-d H:i:s')
        ]);
        $formulaire_a_erreurs = false;
    } else {
        $formulaire_a_erreurs = true;
    }
}
?>


<!DOCTYPE HTML>
<!--
	Landed by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Contact - Loti Didier</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/contact.css" />

		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		
		<script src="assets/js/jquery.min.js" defer></script>
		<script src="assets/js/jquery.scrolly.min.js" defer></script>
		<script src="assets/js/jquery.dropotron.min.js" defer></script>
		<script src="assets/js/jquery.scrollex.min.js" defer></script>
		<script src="assets/js/browser.min.js" defer></script>
		<script src="assets/js/breakpoints.min.js" defer></script>
		<script src="assets/js/util.js" defer></script>
		<script src="assets/js/main.js" defer></script>
		<script src="Java-contact.js" defer></script>
	</head>
	<body class="is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<?php require_once('./includes/header.php'); ?>

			<!-- Contact Banner -->
			
<?php
        
        if ($formulaire_soumis && !$formulaire_a_erreurs) {
            echo "
                <section class='banniere-alerte succes banniere' role='alert' aria-live='polite' data-banniere>

                    <p>Message envoyé !</p>

                    <button data-fermeture-banniere=''>Fermer</button>
                    
                </section>
            ";
        }
        if ($formulaire_soumis && $formulaire_a_erreurs) {
            echo "
                <section class='banniere-alerte erreur banniere' role='alert' aria-live='polite' data-banniere>

                    <p>Votre message possède une erreur !</p>

                    <button data-fermeture-banniere=''>Fermer</button>

                </section>
            ";
        }   
?>			


			<!-- Main -->
				<div id="main" class="wrapper style1">
					<div class="container">
						<header class="major">
							<h2>Contact</h2>
							<?php echo"<p>" .$row['accroche']. "</p>"?>
						</header>

						<!-- Content -->
								<form action="" method="POST" class="">
									<div class="row gtr-uniform gtr-50">

										<article class="col-6 col-12-xsmall">
											<label for="prenom" class="label-champ texte-gras">Prénom</label>
											<input type="text" class="champ" name="prenom" id="prenom">
										</article>

										<article class="col-6 col-12-xsmall">
											<label for="nom" class="label-champ texte-gras">Nom de famille</label>
											<input type="text" class="champ" name="nom" id="nom">
										</article>
										
										<article class="col-12">
											<label for="email" class="label-champ texte-gras">Adresse e-mail</label>
											<input type="email" class="champ" name="email" id="email">
										</article>

										<article class="col-12">
											<label for="message" class="label-champ texte-gras">Message</label>
											<textarea name="message" id="message" cols="30" rows="10" class="champ"></textarea>
										</article>

										<article class="col-12">
											<p class="label-champ texte-gras">Je suis</p>
											<ul class="liste-choix">
												<li class="choix">
													<input type="radio" name="je_suis" id="pas_precise" value="pas_precise">
													<label for="pas_precise">Je ne souhaite pas le préciser</label>
												</li>
												
												<li class="choix">
													<input type="radio" name="je_suis" id="etudiant" value="etudiant">
													<label for="etudiant">Étudiant / Étudiante</label>
												</li>

												<li class="choix">
													<input type="radio" name="je_suis" id="professionnel" value="professionnel">
													<label for="professionnel">Professionnel</label>
												</li>
												
												<li class="choix">
													<input type="radio" name="je_suis" id="autre" value="autre">
													<label for="autre">Autre</label>
												</li>
											</ul>
										</article>
										
										<ul class="actions">
											<li><input type="submit" value="Envoyer" class="primary"></li>
										</ul>
										
									</div>
								
								</form>

								
					</div>
				</div>

			<!-- Footer -->
				<?php require_once('./includes/footer.php'); ?>

		</div>



	</body>
</html>