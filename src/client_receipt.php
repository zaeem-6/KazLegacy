<?php

include "dbConfig.php";

session_start();

$client_ID = $_SESSION['client_ID'];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$client_IC = $_GET['client_IC'];
	$client_name = $_GET['client_name'];
	$client_age = $_GET['client_age'];
	$client_job = $_GET['client_job'];
	$client_phone = $_GET['client_phone'];
	$client_status = $_GET['client_status'];
	$selected_plan = $_GET['selected_plan'];
	$agent_code = $_GET['agent_code'];
	$total = 0;

	$query2 = "select * from agent where agent_code='$agent_code'";
	$result2 = mysqli_query($con, $query2);

	if (mysqli_num_rows($result2) === 1) {
		$row2 = mysqli_fetch_assoc($result2);
		if ($row2['agent_code'] == $agent_code) {
			$agent_name = $row2['agent_name'];
		}
	}
}


?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Client Quotation</title>
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

	<center>
		<div class="notice">Your selected agent will contact you soon</div>
	</center>

	<div class="quotation-card">
		<div class="quotation-title"><b>QUOTATION</b></div>
		<div class="quotation-detail">NRIC &nbsp&nbsp&nbsp&nbsp&nbsp:&nbsp&nbsp <?= $client_IC ?></div>
		<div class="quotation-detail">Name &nbsp&nbsp&nbsp&nbsp:&nbsp&nbsp <?= $client_name ?></div>
		<div class="quotation-detail">Age &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:&nbsp&nbsp <?= $client_age ?></div>
		<div class="quotation-detail">Job &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:&nbsp&nbsp <?= $client_job ?></div>
		<div class="quotation-detail">Phone &nbsp&nbsp&nbsp:&nbsp&nbsp <?= $client_phone ?></div>
		<div class="quotation-detail">Status &nbsp&nbsp&nbsp:&nbsp&nbsp <?= $client_status ?></div>
		<div class="quotation-detail">Agent &nbsp&nbsp&nbsp&nbsp:&nbsp&nbsp <?= $agent_code ?> - <?= $agent_name ?>
		</div>
		<div class="quotation-detail-last">Plan &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:&nbsp&nbsp <?= $selected_plan ?></div>
		<?php

		$plan_arr = explode(", ", $selected_plan);

		foreach ($plan_arr as $plan_arr) {
			$query = "select * from takafulplan where plan_name='$plan_arr'";
			$result = mysqli_query($con, $query);

			$row = $result->fetch_assoc();
			$price = $row["plan_price"];
			$total += $price;

			$query3 = "update quotation set price='$total' where client_IC='$client_IC'";
			$result3 = mysqli_query($con, $query3);
		}



		?>
		<div class="quotation-detail-price">Estimated Price: <b>RM<?= $total ?>/month</b></div>
	</div>

	<center><a href="client_form.php" class="submit-another-button">Submit Another Quotation</a><a
			href="client_quotation.php" class="view-button">View Quotation</a></center>


	<br>
	<br>
	<br>


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