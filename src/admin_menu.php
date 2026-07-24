<?php

include "dbConfig.php";

session_start();

$admin_name = $_SESSION['admin_name'];

$query = "select * from agent";
$result = mysqli_query($con, $query);
$agent_data = mysqli_num_rows($result);

$query2 = "select * from client";
$result2 = mysqli_query($con, $query2);
$client_data = mysqli_num_rows($result2);

$query3 = "select * from takafulplan";
$result3 = mysqli_query($con, $query3);
$plan_data = mysqli_num_rows($result3);

$query4 = "select * from quotation";
$result4 = mysqli_query($con, $query4);
$quotation_data = mysqli_num_rows($result4);

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Menu</title>
	<link rel="stylesheet" href="style.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<style>
	body {
		background-image: url("admin-menu-bg.png");
		background-size: cover;
	}
</style>

<body>

	<header id="header">

		<a href="admin_menu.php" class="FWD"><img src="kazlegacy-logo.png" alt="FWD" width="100" height="30"></a>

		<nav class="navbar">
			<a class="active" href="admin_menu.php">Menu</a>
			<a href="agent_admin.php">Agent</a>
			<a href="client_admin.php">Client</a>
			<a href="plan_admin.php">Plan</a>
			<a href="quotation_admin.php">Quotation</a>
		</nav>

		<div class="admin_logout">
			<a href="admin_logout.php" class="logout-button">Logout</a>
		</div>

	</header>

	<div class="greeting">Welcome, <?= $admin_name ?></div>


	<div class="admin-box">

		<a href="agent_admin.php" class="agent-holder">
			<span class="agent-card-admin">AGENT</span>
			<i class="agent-indicator">Total Agent: <?= $agent_data ?></i>
		</a>

		<a href="client_admin.php" class="client-holder">
			<span class="client-card-admin">CLIENT</span>
			<i class="client-indicator">Total Client: <?= $client_data ?></i>
		</a>

		<a href="plan_admin.php" class="plan-holder">
			<span class="plan-card-admin">PLAN</span>
			<i class="plan-indicator">Total Plan: <?= $plan_data ?></i>
		</a>

		<a href="quotation_admin.php" class="quotation-holder">
			<span class="quotation-card-admin">QUOTATION</span>
			<i class="quotation-indicator-admin">Total Client: <?= $quotation_data ?></i>
		</a>

	</div>










</body>

</html>