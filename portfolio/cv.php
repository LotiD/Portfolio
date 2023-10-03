<?php require_once('./includes/connexion-bdd.php');

$sql= 'SELECT * FROM cv';
$result = $conn->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);
$row = $result->fetch();

$sql2 = " SELECT * FROM formations";
$result2 = $conn->query($sql2);
$result2->setFetchMode(PDO::FETCH_ASSOC);
$row2 = $result2->fetch();
$result2->execute();

$sql3 = " SELECT * FROM skills";
$result3 = $conn->query($sql3);
$result3->setFetchMode(PDO::FETCH_ASSOC);
$row3 = $result3->fetch();
$result3->execute();
?>

<!DOCTYPE HTML>
<!--
	Landed by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>CV - Loti Didier</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<script src="assets/js/jquery.min.js" defer></script>
		<script src="assets/js/jquery.scrolly.min.js" defer></script>
		<script src="assets/js/jquery.dropotron.min.js" defer></script>
		<script src="assets/js/jquery.scrollex.min.js" defer></script>
		<script src="assets/js/browser.min.js" defer></script>
		<script src="assets/js/breakpoints.min.js" defer></script>
		<script src="assets/js/util.js" defer></script>
		<script src="assets/js/main.js" defer></script>
	</head>
	<body class="is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<?php require_once('./includes/header.php'); ?>

			<!-- Main -->
				<div id="main" class="wrapper style1">
					<div class="container">
						<header class="major">
							<h2>CV</h2>
							<?php echo"<p>" .$row['slogan']. "</p>"?>
						</header>
						<div class="row gtr-150">
							<div class="">
								<!-- Content -->
									<section id="content">
										<h2>Formations</h2>
										<?php
											while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
												echo "<div class='col-4 col-6-xsmall'>
														
														<h3>" . $row2['nom'] .  "</h3> <p>" . $row2['annee_debut'] . "/" . $row2['annee_fin'] . "</p>
														<p> " . $row2['description'] . " </p>
														
													

													  </div>"; 
											}
										?>
									</section>
									<section id="content">
										<h2>Compétences</h2>
										<?php
											while ($row3 = $result3->fetch(PDO::FETCH_ASSOC)) {
												echo "<div class='col-4 col-6-xsmall'>
														
														<h3>" . $row3['titre'] .  "</h3> 
														<p> " . $row3['description'] . " </p>
														
													

													  </div>"; 
											}
										?>
									</section>
							</div>
						</div>
					</div>
				</div>

			<!-- Footer -->
				<?php require_once('./includes/footer.php'); ?>

		</div>

	</body>
</html>