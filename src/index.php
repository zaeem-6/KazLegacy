<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
	<link rel="stylesheet" href="style.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

	<header id="header">

		<a href="index.php" class="FWD"><img src="kazlegacy-logo.png" alt="FWD" width="100" height="30"></a>

		<nav class="navbar">
			<a class="active" href="home.php">Home</a>
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

	<section class="sec1">
		<p class="sec1-content1">KAZ LEGACY</p>
		<p class="sec1-content2">Official website under FWD</p>
		<i class='bx bx-chevrons-down'></i>
	</section>

	<section class="sec2">
		<div class="sec2-left-column">
			<p class="sec2-left-column-top">One page, all plan</p>
			<p class="sec2-left-column-bottom">Browse and choose one or more takaful plans provided by FWD Takaful.</p>
			<a href="plan.php" class="sec2-button">Browse Plan <i class='bx bx-right-arrow-alt'></i></a>
		</div>
		<div class="sec2-right-column">
			<img src="fwdplan.png">
		</div>
	</section>

	<section class="sec3">
		<div class="sec3-left-column">
			<img src="agentcompilation.jpeg">
		</div>
		<div class="sec3-right-column">
			<p class="sec3-right-column-top">Your trusted agent</p>
			<p class="sec3-right-column-bottom">Contact these selected agent to get you and your loved ones covered.</p>
			<a href="agent.php" class="sec3-button">View Agent<i class='bx bx-right-arrow-alt'></i></a>
		</div>
	</section>

	<section class="sec4">
		<div class="sec4-left-column">
			<p class="sec4-left-column-top">Testimony from our previous clients</p>
			<p class="sec4-left-column-bottom">We give the best treatment to our clients for trusting us.</p>
			<a href="testimony.php" class="sec3-button">View Testimony<i class='bx bx-right-arrow-alt'></i></a>
		</div>
		<div class="sec4-right-column">
			<img src="testimonycompilation.jpeg">
		</div>
	</section>





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