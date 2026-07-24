<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Testimony</title>
	<link rel="stylesheet" href="style.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

	<header id="header">

		<a href="index.php" class="FWD"><img src="kazlegacy-logo.png" alt="FWD" width="100" height="30"></a>

		<nav class="navbar">
			<a href="index.php">Home</a>
			<a href="plan.php">Plan</a>
			<a class="active" href="testimony.php">Testimony</a>
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

	<center>
		<div class="testimony-title">TESTIMONY</div>
	</center>
	<center>
		<div class="testimony-title-line"></div>
	</center>

	<div class="testimony-container">
		<div class="testimony-column1">
			<div class="testimony-image">
				<img src="testimony1.png">
			</div>
			<div class="testimony-image">
				<img src="testimony2.png">
			</div>
			<div class="testimony-image">
				<img src="testimony3.png">
			</div>
		</div>
		<div class="testimony-column2">
			<div class="testimony-image">
				<img src="testimony6.png">
			</div>
			<div class="testimony-image">
				<img src="testimony4.png">
			</div>
		</div>
		<div class="testimony-column3">
			<div class="testimony-image">
				<img src="testimony9.png">
			</div>
			<div class="testimony-image">
				<img src="testimony11.png">
			</div>
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


	<?php

	include "footer.php";

	?>