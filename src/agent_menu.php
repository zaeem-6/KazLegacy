<?php

include "dbConfig.php";

session_start();

$agent_code = $_SESSION['agent_code'];

$query = "select * from agent where agent_code='$agent_code'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

$agent_name = $row['agent_name'];

$query2 = "select * from quotation where agent_code='$agent_code'";
$result2 = mysqli_query($con, $query2);
$total_quotation = mysqli_num_rows($result2);

?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Agent Menu</title>
	<link rel="stylesheet" href="style.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<style>
	body {
		background-image: url("agent-menu-bg.png");
		background-size: cover;
	}
</style>

<body>

	<header id="header">

		<a href="agent_menu.php" class="FWD"><img src="kazlegacy-logo.png" alt="FWD" width="100" height="30"></a>

		<nav class="navbar">
			<a class="active" href="agent_menu.php">Menu</a>
			<a href="agent_quotation.php">Quotation</a>
			<a href="agent_profile.php">Profile</a>
		</nav>

		<div class="agent_logout">
			<a href="agent_logout.php" class="logout-button">Logout</a>
		</div>

	</header>

	<div class="greeting">Welcome, <?= $agent_name ?></div>

	<div class="agent-box">

		<div class="agent-quotation-card"><a href="agent_quotation.php" class="agent-quotation">Quotation <i
					class="quotation-indicator">Total quotation: <b><?= $total_quotation ?></b></i></a></div>

		<div class="agent-profile-card"><a href="agent_profile.php" class="agent-profile">Profile</a></div>

	</div>


</body>

</html>