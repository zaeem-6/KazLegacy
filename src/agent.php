<?php

include "dbConfig.php";

$query = "select * from agent";
$result = mysqli_query($con, $query);

?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Agent</title>
	<link rel="stylesheet" href="style.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

	<header id="header">

		<a href="index.php" class="FWD"><img src="kazlegacy-logo.png" alt="FWD" width="100" height="30"></a>

		<nav class="navbar">
			<a href="index.php">Home</a>
			<a href="plan.php">Plan</a>
			<a href="testimony.php">Testimony</a>
			<a class="active" href="agent.php">Agent</a>
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
		<div class="agent-title-page">Agent</div>
	</center>
	<center>
		<div class="agent-title-page-line"></div>
	</center>

	<div class="agent-page-container">

		<?php

		while ($row = $result->fetch_assoc()) {
			echo "
			<div class='agent-section'>
				<div class='agent-section-content1'><img class = 'agent-section-picture' src=$row[agent_picture]></div>
				<div class='agent-section-content2'>
					<p class='agent-name'>$row[agent_name]</p>
					<p class='agent-code'><i class='bx bx-user'></i>$row[agent_code]</p>
					<p class='agent-phone'><i class='bx bx-phone'></i>$row[agent_phone]</p>
					<p class='agent-email'><i class='bx bx-envelope' ></i>$row[agent_email]</p>
				</div>
			</div>";
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