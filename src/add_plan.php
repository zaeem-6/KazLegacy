<?php

include "dbConfig.php";

session_start();

$admin_name = $_SESSION['admin_name'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$plan_name = $_POST['plan_name'];
	$plan_description = $_POST['plan_description'];
	$plan_price = $_POST['plan_price'];



	if (!is_numeric($plan_price)) {
		echo '<script>alert("Price must be number only !")</script>';
	} else {
		$query2 = "select * from takafulplan where plan_name='$plan_name'";
		$result2 = mysqli_query($con, $query2);

		if (mysqli_num_rows($result2) > 0) {
			echo '<script>alert("Plan name is already being used!")</script>';
		} else {
			$query = "insert into takafulplan (plan_name, plan_description, plan_price) values ('$plan_name','$plan_description','$plan_price')";
			$result = mysqli_query($con, $query);

			echo '<script>
	        	window.location.href="plan_admin.php";
	        	alert("New plan has been added !");
	        	</script>';
			exit();
		}
	}

}

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Plan</title>
	<link rel="stylesheet" href="style.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

	<header id="header">

		<a href="home.php" class="FWD"><img
				src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/Logo_FWD.svg/2560px-Logo_FWD.svg.png"
				alt="FWD" width="100" height="30"></a>

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

	<div class="admin-agent-title-add-agent">Add New PLan</div>

	<div class="admin-table-container-add-agent">

		<form action="add_plan.php" method="POST">

			<div class="add-agent-info">
				<input type="text" name="plan_name" required=""
					value="<?php if (isset($_POST['plan_name'])) {
						echo $_POST['plan_name'];
					} ?>">
				<label class="agent-info-label">PLAN NAME</label>
			</div>

			<div class="add-agent-info">
				<input type="text" name="plan_description" required=""
					value="<?php if (isset($_POST['plan_description'])) {
						echo $_POST['plan_description'];
					} ?>">
				<label class="agent-info-label">PLAN DESCRIPTION</label>
			</div>

			<div class="add-agent-info">
				<input type="text" name="plan_price" required=""
					value="<?php if (isset($_POST['plan_price'])) {
						echo $_POST['plan_price'];
					} ?>">
				<label class="agent-info-label">PLAN PRICE</label>
			</div>

			<button class="submit-button">ADD</button>

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