<?php

include "dbConfig.php";

session_start();

$client_ID = $_SESSION['client_ID'];

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if (!isset($_GET['quotation_ID'])) {
		header("Location: client_quotation.php");
		exit();
	}

	$quotation_ID = $_GET['quotation_ID'];

	$query = "select * from quotation where quotation_ID=$quotation_ID";
	$result = mysqli_query($con, $query);
	$row = $result->fetch_assoc();

	if (!$row) {
		header("Location: client_quotation.php");
		exit();
	}

	$client_IC = $row["client_IC"];
	$client_name = $row["client_name"];
	$client_age = $row["client_age"];
	$client_job = $row["client_job"];
	$client_phone = $row["client_phone"];
	$client_status = $row["client_status"];
	$selected_plan = $row["selected_plan"];
	$agent_code = $row["agent_code"];

	$query2 = "select * from agent where agent_code='$agent_code'";
	$result2 = mysqli_query($con, $query2);
	$row2 = $result2->fetch_assoc();

	$agent_name = $row2["agent_name"];

	$price = $row["price"];
}


?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>View Quotation</title>
	<link rel="stylesheet" href="style.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

	<header id="header">

		<a href="client_menu.php" class="FWD"><img src="kazlegacy-logo.png" alt="FWD" width="100" height="30"></a>

		<nav class="navbar">
			<a href="client_menu.php">Menu</a>
			<a href="client_form.php">Form</a>
			<a href="client_quotation.php">Quotation</a>
		</nav>

		<div class="client_logout">
			<a href="client_logout.php" class="logout-button">Logout</a>
		</div>

	</header>

	<div class="pdf-button">
		<a class="pdf" href="download.php?quotation_ID=<?= $quotation_ID ?>"><i class='bx bx-save'></i></a>
	</div>

	<div class="view-quotation-container">

		<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/Logo_FWD.svg/2560px-Logo_FWD.svg.png"
			alt="FWD" width="100" height="30">
		<p class="office-address">No. 211, 29th Floor Menara Shell, Jalan Tun Sambanthan, 50470 Kuala Lumpur</p>

		<div class="view-quotation-info">
			<div class="quotation-header">
				<div class="quotation-header-content">QUOTATION ID #<?= $quotation_ID ?></div>
				<div class="quotation-header-content"><b>EST PRICE <br>RM<?= $price ?></b></div>
			</div>

			<div class="view-quotation-details">

				<p class="view-quotation-title">NRIC</p>
				<p class="view-quotation-content"><?= $client_IC ?></p>

				<p class="view-quotation-title">NAME</p>
				<p class="view-quotation-content"><?= $client_name ?></p>

				<p class="view-quotation-title">AGE</p>
				<p class="view-quotation-content"><?= $client_age ?></p>

				<p class="view-quotation-title">JOB</p>
				<p class="view-quotation-content"><?= $client_job ?></p>

				<p class="view-quotation-title">PHONE</p>
				<p class="view-quotation-content"><?= $client_phone ?></p>

				<p class="view-quotation-title">STATUS</p>
				<p class="view-quotation-content"><?= $client_status ?></p>

				<p class="view-quotation-title">SELECTED PLAN</p>
				<p class="view-quotation-content"><?= $selected_plan ?></p>

				<p class="view-quotation-title">AGENT</p>
				<p class="view-quotation-content"><?= $agent_code ?> - <?= $agent_name ?></p>

			</div>
		</div>

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