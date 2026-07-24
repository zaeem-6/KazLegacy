<?php

include "dbConfig.php";

session_start();

$client_ID = $_SESSION['client_ID'];

?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Client Menu</title>
	<link rel="stylesheet" href="style.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<style>
	body {
		background-image: url("client-menu.png");
		background-size: cover;
	}
</style>

<body>

	<header id="header">

		<a href="client_menu.php" class="FWD"><img src="kazlegacy-logo.png" alt="FWD" width="100" height="30"></a>

		<nav class="navbar">
			<a class="active" href="client_menu.php">Menu</a>
			<a href="client_form.php">Form</a>
			<a href="client_quotation.php">Quotation</a>
		</nav>

		<div class="client_logout">
			<a href="client_logout.php" class="logout-button">Logout</a>
		</div>

	</header>

	<div class="client-box">

		<a href="client_form.php" class="client-holder">
			<span class="agent-card-admin">FORM</span>
		</a>

		<a href="client_quotation.php" class="quotation-client-holder">
			<span class="client-card-admin">QUOTATION</span>
		</a>

	</div>


</body>

</html>