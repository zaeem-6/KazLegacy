<?php

include "dbConfig.php";

session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$admin_username = $_POST['admin_username'];
	$admin_password = $_POST['admin_password'];

	$query = "select * from admin where admin_username='$admin_username' and admin_password='$admin_password'";
	$result = mysqli_query($con, $query);

	if (mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_assoc($result);
		if ($row['admin_username'] == $admin_username && $row['admin_password'] == $admin_password) {
			$_SESSION['admin_name'] = $row['admin_name'];
			header("Location: admin_menu.php");
			exit();
		}
	} else {
		echo '<script>alert("Invalid username or password!")</script>';
	}

}

?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Login</title>
	<link rel="stylesheet" href="style.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<style>
	body {
		background-image: url("admin-login-bg.png");
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

	<form class="admin-login-form" action="admin_login.php" method="POST">

		<div class="admin-login-title">Admin Login</div>

		<div class="admin-username-login">
			<input type="text" name="admin_username" required="">
			<label class="admin-username-label">Username</label>
		</div>

		<div class="admin-password-login">
			<input type="password" name="admin_password" required="">
			<label class="admin-password-label">Password</label>
		</div>

		<center>

			<div class="button-for-admin">
				<button class="admin-submit-button">Login</button>
			</div>

		</center>

	</form>

</body>

</html>