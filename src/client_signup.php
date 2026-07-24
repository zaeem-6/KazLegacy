<?php

include "dbConfig.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$client_username_signup = $_POST['client_username_signup'];
	$client_email_signup = $_POST['client_email_signup'];
	$client_password_signup = $_POST['client_password_signup'];
	$client_conpassword_signup = $_POST['client_conpassword_signup'];


	if (preg_match('/\s/', $client_username_signup)) {
		echo '<script>alert("Username cannot contain space!")</script>';
	} elseif (!filter_var($client_email_signup, FILTER_VALIDATE_EMAIL)) {
		echo '<script>alert("Email is invalid!")</script>';
	} elseif ($client_username_signup == $client_password_signup) {
		echo '<script>alert("Username and password cannot match!")</script>';
	} elseif (!preg_match('@[A-Z]@', $client_password_signup)) {
		echo '<script>alert("Password must contain uppercase!")</script>';
	} elseif (!preg_match('@[a-z]@', $client_password_signup)) {
		echo '<script>alert("Password must contain lowercase!")</script>';
	} elseif (!preg_match('@[0-9]@', $client_password_signup)) {
		echo '<script>alert("Password must contain number!")</script>';
	} elseif (strlen($client_password_signup) < 5) {
		echo '<script>alert("Password should be at least 5 characters long!")</script>';
	} elseif ($client_conpassword_signup != $client_password_signup) {
		echo '<script>alert("Password does not match!")</script>';
	} else {
		$checkEmail = "select * from client where client_email='$client_email_signup'";
		$resultEmail = mysqli_query($con, $checkEmail);

		if (mysqli_num_rows($resultEmail) > 0) {
			echo '<script>alert("Email is already being used!")</script>';
		} else {
			$client_username_signup = $client_username_signup;
			$client_password_signup = $client_password_signup;
			$query = "insert into client (client_email,client_username,client_password) values ('$client_email_signup','$client_username_signup','$client_password_signup')";
			mysqli_query($con, $query);
			echo '<script> 
			window.location.href = "client_login.php";
			alert("Registered! You can login now")
			</script>';
		}
	}

}

?>



<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Client Signup</title>
	<link rel="stylesheet" href="style.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<style>
	body {
		background-image: url("client-signup-bg.png");
		background-size: cover;
	}
</style>

<body>

	<header id="header">

		<a href="index.php" class="FWD"><img src="kazlegacy-logo.png" alt="FWD" width="100" height="30"></a>

		<nav class="navbar">
			<a href="home.php">Home</a>
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

	<form class="client-signup-form" action="client_signup.php" method="POST">

		<div class="client-signup-title">Client Signup</div>

		<div class="client-username-signup">
			<input type="text" name="client_username_signup" value="<?php if (isset($_POST['client_username_signup'])) {
				echo $_POST['client_username_signup'];
			} ?>" required="">
			<label class="client-username-label">Username</label>
		</div>

		<div class="client-email-signup">
			<input type="text" name="client_email_signup" value="<?php if (isset($_POST['client_email_signup'])) {
				echo $_POST['client_email_signup'];
			} ?>" required="">
			<label class="client-email-label">Email</label>
		</div>

		<div class="client-password-signup">
			<input type="password" name="client_password_signup" required="" id="client_password_signup" value="<?php if (isset($_POST['client_password_signup'])) {
				echo $_POST['client_password_signup'];
			} ?>">
			<label class="client-password-label">Password</label>
		</div>

		<p class="password-requirements">Password must contain :
		<ul class="requirements">
			<li>At least 5 characters</li>
			<li>Uppercase</li>
			<li>Lowercase</li>
			<li>Number</li>
		</ul>
		</p>

		<br>

		<div class="client-conpassword-signup">
			<input type="password" name="client_conpassword_signup" required="" id="client_conpassword_signup" value="<?php if (isset($_POST['client_conpassword_signup'])) {
				echo $_POST['client_conpassword_signup'];
			} ?>">
			<label class="client-password-label">Confirm Password</label>
		</div>

		<label class="show-password">
			<input type="checkbox" class="password-checkbox" onclick="myFunction()">
			Show Password
		</label>

		<center>

			<div class="signup-button">
				<a href="client_login.php" class="back-button">Back</a>
				<button class="client-submit-button">Signup</button>
			</div>

		</center>

	</form>

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

		function myFunction() {
			var x = document.getElementById("client_password_signup");
			var y = document.getElementById("client_conpassword_signup");
			if (x.type === "password" && y.type === "password") {
				x.type = "text";
				y.type = "text";
			}
			else {
				x.type = "password";
				y.type = "password";
			}
		}
	</script>
</body>

</html>