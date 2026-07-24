<?php

include "dbConfig.php";

session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$client_username = $_POST['client_username'];
	$client_password = $_POST['client_password'];

	if ($client_username == $client_password) {
		echo '<script>alert("Invalid username or password!")</script>';
	} else {
		$query = "select * from client where client_username='$client_username' and client_password='$client_password'";
		$result = mysqli_query($con, $query);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
			if ($row['client_username'] == $client_username && $row['client_password'] == $client_password) {
				$_SESSION['client_ID'] = $row['client_ID'];
				header("Location: client_menu.php");
				exit();
			}
		} else {
			echo '<script>alert("Invalid username or password!")</script>';
		}
	}

}

?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Client Login</title>
	<link rel="stylesheet" href="style.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<style>
	body {
		background-image: url("client-bg2.png");
		background-size: cover;
	}
</style>

<body>

	<header id="header">

		<a href="index.php" class="FWD"><img src="kazlegacy-logo.png" alt="FWD" width="100" height="30"></a>

		<nav class="navbar">
			<a href="index.php">Home</a>
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

	<form class="client-login-form" action="client_login.php" method="POST">

		<div class="client-login-title">Client Login</div>

		<div class="client-username-login">
			<input type="text" name="client_username" required="">
			<label class="client-username-label">Username</label>
		</div>

		<div class="client-password-login">
			<input type="password" name="client_password" required="" id="client_password">
			<label class="client-password-label">Password</label>
		</div>

		<label class="show-password">
			<input type="checkbox" class="password-checkbox" onclick="myFunction()">
			Show Password
		</label>

		<center>

			<div class="button-for-client">
				<button class="client-submit-button">Login</button>
			</div>

			<div class="new-member"><em>Doesn't have an account?</em> <a class="signup" href="client_signup.php">Sign
					Up</a></div>
		</center>

	</form>



	<script>

		function myFunction() {
			var x = document.getElementById("client_password");
			if (x.type === "password") {
				x.type = "text";
			}
			else {
				x.type = "password";
			}
		}
	</script>

</body>

</html>