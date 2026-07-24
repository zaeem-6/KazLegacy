<?php

include "dbConfig.php";

session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$agent_code = $_POST['agent_code'];
	$agent_password = $_POST['agent_password'];

	$query = "select * from agent where agent_code='$agent_code' and agent_password='$agent_password'";
	$result = mysqli_query($con, $query);

	if (mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_assoc($result);
		if ($row['agent_code'] == $agent_code && $row['agent_password'] == $agent_password) {
			$_SESSION['agent_code'] = $row['agent_code'];
			header("Location: agent_menu.php");
			exit();
		}
	} else {
		echo '<script>alert("Invalid code or password!")</script>';
	}


}

?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Agent Login</title>
	<link rel="stylesheet" href="style.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<style>
	body {
		background-image: url("agent-bg.png");
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

	<form class="agent-login-form" action="agent_login.php" method="POST">

		<div class="agent-login-title">Agent Login</div>

		<div class="agent-code-login">
			<input type="text" name="agent_code" required="">
			<label class="agent-code-label">Agent Code</label>
		</div>

		<div class="agent-password-login">
			<input type="password" name="agent_password" required="">
			<label class="agent-password-label">Password</label>
		</div>

		<center>

			<div class="button-for-agent">
				<button class="agent-submit-button">Login</button>
			</div>

		</center>

	</form>

</body>

</html>