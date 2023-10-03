<?php require_once('./includes/connexion-bdd.php'); 

$sql= 'SELECT * FROM accueil';
$result = $conn->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);
$row = $result->fetch();?>

<!DOCTYPE HTML>
<!--
	Landed by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->

<html>
	<head>
		<title>Accueil - Loti Didier</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js" defer></script>
			<script src="assets/js/jquery.dropotron.min.js" defer></script>
			<script src="assets/js/jquery.scrollex.min.js" defer></script>
			<script src="assets/js/browser.min.js" defer></script>
			<script src="assets/js/breakpoints.min.js" defer></script>
			<script src="assets/js/util.js" defer></script>
			<script src="assets/js/main.js" defer></script>
	</head>
	<body class="is-preload landing">
		<div id="page-wrapper">
			
		<!-- Header -->
			<?php require_once('./includes/header.php'); ?>
			

			<!-- Banner -->
				<section id="banner">
					<div class="content">
						<header>
							<?php echo"<h2>" .$row['nom']. " " . $row["prenom"] . "</h2>"?>
							<?php echo"<p>" .$row['accroche']. "</p>"?>
						</header>
					</div>
					<a href="#two" class="goto-next scrolly">Next</a>
				</section>

			<!-- Two -->
				<section id="two" class="spotlight style2 right">
					<span class="image fit main"><img src="images/pic03.jpg" alt="" /></span>
					<div class="content">
						<header>
						<?php echo"<h2>" .$row['apercu_titre_1']. "</h2>"?>
							<?php echo"<p>" .$row['apercu_accroche_1']. "</p>"?>
						</header>
						<?php echo"<p>" .$row['apercu_description_1']. "</p>"?>
						<ul class="actions">
							<li><a href="cv.php" class="button">En savoir plus</a></li>
						</ul>
					</div>
					<a href="#three" class="goto-next scrolly">Next</a>
				</section>

			<!-- Three -->
				<section id="three" class="spotlight style3 left">
					<span class="image fit main bottom"><img src="images/pic04.jpg" alt="" /></span>
					<div class="content">
						<header>
						<?php echo"<h2>" .$row['apercu_titre_2']. "</h2>"?>
							<?php echo"<p>" .$row['apercu_accroche_2']. "</p>"?>
						</header>
						<?php echo"<p>" .$row['apercu_description_2']. "</p>"?>
						<ul class="actions">						<ul class="actions">
							<li><a href="portfolio.php" class="button">En savoir plus</a></li>
						</ul>
					</div>
					<a href="#four" class="goto-next scrolly">Next</a>
				</section>
				<?php require_once('./includes/footer.php'); ?>

		</div>

	</body>
</html>