<?php

include "dbConfig.php";

session_start();

$client_ID = $_SESSION['client_ID'];

$query = "select * from takafulplan";
$result = mysqli_query($con, $query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$client_IC = $_POST['client_IC'];
	$client_name = $_POST['client_name'];
	$client_age = $_POST['client_age'];
	$client_job = $_POST['client_job'];
	$client_phone = $_POST['client_phone'];
	$complete_date = "N/A";

	if (!preg_match("/^\d{6}-\d{2}-\d{4}$/", $client_IC)) {
		echo '<script>alert("NRIC is invalid!")</script>';
	} elseif (!preg_match("/^[a-zA-Z]+(?:[ \t][a-zA-Z]+)*$/", $client_name)) {
		echo '<script>alert("Name must contain alphabet only!")</script>';
	} elseif (!is_numeric($client_age)) {
		echo '<script>alert("Age must be number only!")</script>';
	} elseif (!preg_match("/^[a-zA-Z]+(?:[ \t][a-zA-Z]+)*$/", $client_job)) {
		echo '<script>alert("Job must contain alphabet only!")</script>';
	} elseif (!preg_match("/^0(?:[1-9]-\d{7,8}|[1-9]\d{1}-\d{7,8})$/", $client_phone)) {
		echo '<script>alert("Phone is invalid!")</script>';
	} elseif (!isset($_POST['client_status'])) {
		echo '<script>alert("Please choose smoker or non-smoker!")</script>';
	} elseif (!isset($_POST['planname'])) {
		echo '<script>alert("Please select one or more plan!")</script>';
	} elseif (!isset($_POST['agent_code'])) {
		echo '<script>alert("Please select one agent!")</script>';
	} else {
		$progress = "Pending";
		$client_status = $_POST['client_status'];
		$plan_name = $_POST['planname'];
		$selected_plan = implode(", ", $plan_name);

		$total_price = 0;
		foreach ($plan_name as $plan) {
			$plan = mysqli_real_escape_string($con, $plan);
			$priceQuery = mysqli_query($con, "SELECT plan_price FROM takafulplan WHERE plan_name = '$plan'");
			$priceRow = mysqli_fetch_assoc($priceQuery);
			$total_price += $priceRow['plan_price'];
		}
		$selected_plan = implode(", ", $plan_name);
		$agent_code = $_POST['agent_code'];
		$query = "insert into quotation (client_ID, client_IC, client_name, client_age, client_job, client_phone, client_status, selected_plan, agent_code, complete_date, progress, price) values ('$client_ID', '$client_IC','$client_name','$client_age','$client_job','$client_phone','$client_status','$selected_plan','$agent_code','$complete_date', '$progress', '$total_price')";
		mysqli_query($con, $query);

		header("Location: client_receipt.php?client_IC=" . $client_IC . "&client_name=" . $client_name . "&client_age=" . $client_age . "&client_job=" . $client_job . "&client_phone=" . $client_phone . "&client_status=" . $client_status . "&selected_plan=" . $selected_plan . "&agent_code=" . $agent_code);
	}

}

?>



<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<title>Client Form</title>
</head>

<body>

	<header id="header">

		<a href="client_menu.php" class="FWD"><img src="kazlegacy-logo.png" alt="FWD" width="100" height="30"></a>

		<nav class="navbar">
			<a href="client_menu.php">Menu</a>
			<a class="active" href="client_form.php">Form</a>
			<a href="client_quotation.php">Quotation</a>
		</nav>

		<div class="client_logout">
			<a href="client_logout.php" class="logout-button">Logout</a>
		</div>

	</header>

	<form action="client_form.php" method="POST">

		<div class="step-title">Step 1 <span class="step1-desc">*Fill in your personal information</span></div>
		<div class="step1">

			<div class="client-info">
				<input type="text" name="client_IC" required="" placeholder="(eg. 000000-00-0000)" value="<?php if (isset($_POST['client_IC'])) {
					echo $_POST['client_IC'];
				} ?>">
				<label class="client-info-label">NRIC </label>
			</div>

			<div class="client-info">
				<input type="text" name="client_name" required="" value="<?php if (isset($_POST['client_name'])) {
					echo $_POST['client_name'];
				} ?>">
				<label class="client-info-label">FULL NAME </label>
			</div>

			<div class="client-info">
				<input type="number" name="client_age" min="1" required="" value="<?php if (isset($_POST['client_age'])) {
					echo $_POST['client_age'];
				} ?>">
				<label class="client-info-label">AGE </label>
			</div>

			<div class="client-info">
				<input type="text" name="client_job" required="" value="<?php if (isset($_POST['client_job'])) {
					echo $_POST['client_job'];
				} ?>">
				<label class="client-info-label">JOB </label>
			</div>

			<div class="client-info">
				<input type="text" name="client_phone" required="" placeholder="(eg. 000-0000000)" value="<?php if (isset($_POST['client_phone'])) {
					echo $_POST['client_phone'];
				} ?>">
				<label class="client-info-label">PHONE </label>
			</div>

			<div class="radio-button-container">
				<div class="radio-button">
					<input type="radio" class="radio-button-input" id="radio1" name="client_status" value="Smoker" <?php if (isset($_POST['client_status']) && $_POST['client_status'] === 'Smoker') {
						echo 'checked';
					} ?>>
					<label class="radio-button-label" for="radio1">
						<span class="radio-button-circle"></span>
						Smoker
					</label>
				</div>
				<div class="radio-button">
					<input type="radio" class="radio-button-input" id="radio2" name="client_status" value="Non-smoker"
						<?php if (isset($_POST['client_status']) && $_POST['client_status'] === 'Non-smoker') {
							echo 'checked';
						} ?>>
					<label class="radio-button-label" for="radio2">
						<span class="radio-button-circle"></span>
						Non-smoker
					</label>
				</div>

			</div>
		</div>


		<div class="step-title">Step 2 <span class="step2-desc">*Select one or more plan</span></div>

		<div class="step2">

			<?php

			while ($row = $result->fetch_assoc()) {
				$checked = isset($_POST['planname']) && in_array($row['plan_name'], $_POST['planname']) ? 'checked' : '';
				echo "
				<div class='card-container'>
  			<div class='plan-card'>
    		<input class='plan-checkbox' type='checkbox' name='planname[]' value='$row[plan_name]' $checked>
    		<span class='check'></span>
    		<label class='checkbox-label'>
      	<div class='checkbox-title'>$row[plan_name]</div>
    		</label>
  			</div>
  			</div>
  			<br>
				";
			}

			?>

		</div>
		</div>


		<div class="step-title">Step 3 <span class="step1-desc">*Select one agent</span></div>

		<div class="step3">

			<?php

			$query2 = "select * from agent";
			$result2 = mysqli_query($con, $query2);

			while ($row2 = $result2->fetch_assoc()) {
				$checkedAgent = isset($_POST['agent_code']) && $_POST['agent_code'] === $row2['agent_code'] ? 'checked' : '';

				echo "
				<div class='agent-card-container'>
  			<div class='plan-card'>
    		<input class='plan-checkbox' type='radio' name='agent_code' value='$row2[agent_code]' $checkedAgent>
    		<span class='check'></span>
    		<label class='checkbox-label'>
      	<div class='checkbox-title'>$row2[agent_code] - $row2[agent_name]</div>
    		</label>
  			</div>
  			</div>
  			<br>
				";
			}

			?>
		</div>


		<button class="submit-button">Submit</button>

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
	</script>


</body>

</html>