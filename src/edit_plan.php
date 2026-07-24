<?php

include "dbConfig.php";

session_start();

$admin_name = $_SESSION['admin_name'];


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if (!isset($_GET['plan_name'])) {
		header("Location: plan_admin.php");
		exit();
	}

	$plan_name = $_GET['plan_name'];

	$query = "select * from takafulplan where plan_name='$plan_name'";
	$result = mysqli_query($con, $query);
	$row = $result->fetch_assoc();

	if (!$row) {
		header("Location: plan_admin.php");
		exit();
	}

	$plan_description = $row["plan_description"];
	$plan_price = $row["plan_price"];

} else {
	$plan_name = $_POST['plan_name'];
	$plan_description = $_POST['plan_description'];
	$plan_price = $_POST['plan_price'];


	if (!is_numeric($plan_price)) {
		echo '<script>alert("Price must be number only !")</script>';
	} else {

		$query = "update takafulplan set plan_description='$plan_description', plan_price='$plan_price' where plan_name='$plan_name'";
		$result = mysqli_query($con, $query);

		echo '<script>
	        	window.location.href="plan_admin.php";
	        	alert("Plan has been updated !");
	        	</script>';
		exit();
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Plan</title>
	<link rel="stylesheet" href="style.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

	<header id="header">
		<a href="admin_menu.php" class="FWD"><img src="kazlegacy-logo.png" alt="FWD" width="100" height="30"></a>

		<nav class="navbar">
			<a href="admin_menu.php">Menu</a>
			<a href="agent_admin.php">Agent</a>
			<a href="client_admin.php">Client</a>
			<a href="plan_admin.php">Plan</a>
			<a href="quotation_admin.php">Quotation</a>
		</nav>

		<div class="admin_logout">
			<a href="admin_logout.php" class="logout-button">Logout</a>
		</div>

	</header>

	<div class="admin-agent-title-add-agent">Edit Plan</div>

	<div class="admin-table-container-add-agent">

		<form action="edit_plan.php" method="POST">

			<input type="hidden" name="plan_name" required="" value="<?= $plan_name ?>">

			<div class="edit-agent-info">
				<input type="text" name="plan_description" required="" value="<?= $plan_description ?>">
				<label class="agent-info-label">PLAN DESCRIPTION</label>
			</div>

			<div class="edit-agent-info">
				<input type="text" name="plan_price" required="" value="<?= $plan_price ?>">
				<label class="agent-info-label">PLAN PRICE</label>
			</div>

			<button class="update-button">UPDATE</button>

		</form>



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




</body>

</html>