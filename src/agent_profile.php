<?php

include "dbConfig.php";

session_start();

$agent_code = $_SESSION['agent_code'];

$query = "select * from agent where agent_code='$agent_code'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

$agent_name = $row["agent_name"];
$agent_phone = $row["agent_phone"];
$agent_email = $row["agent_email"];
$agent_picture = $row["agent_picture"];

$query2 = "select * from quotation where agent_code='$agent_code'";
$result2 = mysqli_query($con, $query2);
$total_quotation = mysqli_num_rows($result2);

$completed_quotation = 0;
$pending_quotation = 0;
$circular_bar = 0;
$percentage = 0;

while ($row2 = $result2->fetch_assoc()) {

	$progress = $row2["progress"];

	if ($progress == "Pending") {
		$pending_quotation++;
	}

	if ($progress == "Completed") {
		$completed_quotation++;
	}
	$circular_bar = ($completed_quotation / $total_quotation) * 100;
	$percentage = number_format($circular_bar, 0);

}
$gradient_stop_1 = $circular_bar . "%";
$gradient_stop_2 = $circular_bar . "%";


?>



<!DOCTYPE html>
<html>

<style>
	.circular-bar {
		position: relative;
		margin-left: 50px;
		width: 150px;
		height: 150px;
		border-radius: 50%;
		background-image: conic-gradient(#8f00ba 0%,
				#fd3aff
				<?= $gradient_stop_1 ?>
				,
				#e0e0e0
				<?= $gradient_stop_2 ?>
				100%,
				#8f00ba 0% 0%);
		box-shadow: 5px 5px 10px #a6a6a6, -5px -5px 10px #ffffff;
	}

	.second-circle {
		position: absolute;
		display: flex;
		align-items: center;
		justify-content: center;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		width: 100px;
		height: 100px;
		border-radius: 50%;
		background-color: #e0e0e0;
		box-shadow: inset 5px 5px 10px #a6a6a6, inset -5px -5px 10px #ffffff;

	}

	.percentage {
		text-shadow: 3px 3px 6px rgba(186, 186, 186, 0.81);
		font-size: 24px;
	}
</style>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Agent Profile</title>
	<link rel="stylesheet" href="style.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

	<header id="header">

		<a href="agent_menu.php" class="FWD"><img src="kazlegacy-logo.png" alt="FWD" width="100" height="30"></a>

		<nav class="navbar">
			<a href="agent_menu.php">Menu</a>
			<a href="agent_quotation.php">Quotation</a>
			<a class="active" href="agent_profile.php">Profile</a>
		</nav>

		<div class="agent_logout">
			<a href="agent_logout.php" class="logout-button">Logout</a>
		</div>

	</header>

	<div class="agent-profile-container">

		<div class="agent-container">

			<div class="agent-container-left">
				<div class="agent-picture">
					<img src="<?= $agent_picture ?>">
				</div>
			</div>

			<div class="agent-container-right">

				<div class="agent-details">
					<p class="agent-details-title">AGENT CODE</p>
					<p class="agent-details-info"><?= $agent_code ?></p>
				</div>

				<div class="agent-details">
					<p class="agent-details-title">AGENT NAME</p>
					<p class="agent-details-info"><?= $agent_name ?></p>
				</div>

				<div class="agent-details">
					<p class="agent-details-title">AGENT PHONE</p>
					<p class="agent-details-info"><?= $agent_phone ?></p>
				</div>

				<div class="agent-details">
					<p class="agent-details-title">AGENT EMAIL</p>
					<p class="agent-details-info-last"><?= $agent_email ?></p>
				</div>

				<a href="agent_edit_profile.php"><span class="edit-agent-button">EDIT</span></a>

			</div>

		</div>

		<div class="progress">

			<div class="progress-top">
				<center>
					<div class="progress-top-text1"><?= $pending_quotation ?></div>
					<div class="progress-top-text2">Pending Quotation</div>
				</center>
			</div>

			<div class="progress-bottom">
				<div class="circular-bar">
					<div class="second-circle">
						<div class="percentage"><?= $percentage ?>%</div>
					</div>
				</div>

				<div class="progress-bottom-text">Quotation Completed</div>
			</div>

		</div>


	</div>









</body>

</html>