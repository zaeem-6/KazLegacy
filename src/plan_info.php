<?php

include "dbConfig.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if (isset($_GET['plan_name'])) {
		$plan_name = $_GET['plan_name'];

		$query = "select * from takafulplan where plan_name='$plan_name'";
		$result = mysqli_query($con, $query);
		$row = $result->fetch_assoc();

		if (!$row) {
			echo '<script>
			window.location.href = "home.php";
			alert("No data recorded")
			</script>';
		}

		$plan_name = $row["plan_name"];
		$plan_description = $row["plan_description"];
		$plan_price = $row["plan_price"];

	}
}

?>




<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Plan Info</title>
	<link rel="stylesheet" href="style.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<style>
	body {
		background-image: url("plan-info-bg.png");
		background-size: cover;
	}
</style>

<body>

	<header id="header">

		<a href="index.php" class="FWD"><img src="kazlegacy-logo.png" alt="FWD" width="100" height="30"></a>

		<nav class="navbar">
			<a href="home.php">Home</a>
			<a href="plan.php">Plan</a>
			<a href="testimony.php">Testimony</a>
			<a href="agent.php">Agent</a>
		</nav>

		<div class="login">
			<button class="button">Login</button>
			<div class="button-content">
				<a href="admin_login.php">Admin<i class='bx bx-right-arrow-alt'></i></a>
				<a href="agent_login.php">Agent<i class='bx bx-right-arrow-alt'></i></a>
				<a href="client_login.php">Client<i class='bx bx-right-arrow-alt'></i></a>
			</div>
		</div>

	</header>

	<div class="plan-container">
		<p class="plan-title"><?= $plan_name ?></p>
		<p class="plan-info-title">DESCRIPTION</p>
		<p class="plan-info"><?= $plan_description ?></p>
		<p class="plan-info-title">PRICE</p>
		<p class="plan-info">As low as RM<?= $plan_price ?></p>

		<div class="plan-button">

			<a href="plan.php" class="back-button">Back</a>
			<a href="client_login.php" class="apply-button">Apply now</a>

		</div>

	</div>


	<script>
		var prevScrollpos = window.pageYOffset;
		window.onscroll = function () {
			var currentScrollPos = window.pageYOffset;
			if (prevScrollpos > currentScrollPos) {
				document.getElementById("header").style.top = "15px";
			} else {
				document.getElementById("header").style.top = "-13%";
			}
			prevScrollpos = currentScrollPos;
		}
	</script>

</body>

</html>