<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'mon_portfolio_2';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>