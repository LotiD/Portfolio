<?php require_once('./includes/connexion-bdd.php');

$sql= 'SELECT * FROM portfolio';
$result = $conn->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);
$row = $result->fetch();
$result->execute();
$result->closeCursor();

$sql2 = " SELECT * FROM projets";
$result2 = $conn->query($sql2);
$result2->setFetchMode(PDO::FETCH_ASSOC);
$row2 = $result2->fetch();
$result2->execute();

?>

<!DOCTYPE HTML>
<!--
	Landed by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Portfolio - Loti</title>
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
							<h2>Portfolio</h2>
							<?php echo"<p>" .$row['accroche']. "</p>"?>
						</header>
						<div class="box alt">
							<div class="row gtr-50 gtr-uniform">
								<?php
									while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
										echo "<div class='col-4 col-6-xsmall'>
												<span class='image fit'>
													<img src='./administration/portfolio/" . $row2["image"] . "' alt='' />
												</span>
												<p>" . $row2['nom_projet'] .  "</p>
												<p>" . $row2['description'] . "</p>
											

												</div>"; 
									}
								?>
							</div>
						</div>
					</div>
				</div>

			<!-- Footer -->
				<?php require_once('./includes/footer.php'); ?>

		</div>



	</body>
</html>