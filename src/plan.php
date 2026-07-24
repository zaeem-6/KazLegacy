<?php

include "dbConfig.php";

?>



<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Plan</title>
	<link rel="stylesheet" href="style.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<style>
	body {
		background-image: url("home-bg.png");
		background-repeat: no-repeat;
		background-size: cover;
	}
</style>

<body>

	<header id="header">

		<a href="index.php" class="FWD"><img src="kazlegacy-logo.png" alt="FWD" width="100" height="30"></a>

		<nav class="navbar">
			<a href="index.php">Home</a>
			<a class="active" href="home.php">Plan</a>
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



	<center>
		<div class="title">TAKAFUL PLAN</div>
	</center>
	<center>
		<div class="title-line"></div>
	</center>

	<div class="card-plan-container">
		<?php

		$query = "select * from takafulplan";
		$result = mysqli_query($con, $query);

		while ($row = $result->fetch_assoc()) {
			echo "
		<a href='plan_info.php?plan_name=$row[plan_name]'>
			<div class='card-plan'>
				<div class='card-title'>$row[plan_name]</div>
				<div class='card-desc'>$row[plan_description]</div>
				<div class='card-arrow'><i class='bx bx-right-arrow-alt'></i></div>
			</div>
		</a>
		";
		}

		?>
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