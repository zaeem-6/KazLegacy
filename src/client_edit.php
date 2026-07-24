<?php

include "dbConfig.php";

session_start();

$client_ID = $_SESSION['client_ID'];

$query3 = "select * from takafulplan";
$result3 = mysqli_query($con, $query3);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if (!isset($_GET['quotation_ID'])) {
		header("Location: client_quotation.php");
		exit();
	}

	$quotation_ID = $_GET['quotation_ID'];

	$query = "select * from quotation where quotation_ID='$quotation_ID'";
	$result = mysqli_query($con, $query);
	$row = $result->fetch_assoc();

	if (!$row) {
		header("Location: client_menu.php");
		exit();
	}

	$client_IC = $row["client_IC"];
	$client_name = $row["client_name"];
	$client_age = $row["client_age"];
	$client_phone = $row["client_phone"];
	$client_job = $row["client_job"];
	$client_status = $row["client_status"];
	$selected_plan = $row["selected_plan"];
	$agent_code = $row["agent_code"];
	$plans = explode(", ", $selected_plan);
} else {
	$quotation_ID = $_POST['quotation_ID'];
	$client_IC = $_POST['client_IC'];
	$client_name = $_POST['client_name'];
	$client_age = $_POST['client_age'];
	$client_phone = $_POST['client_phone'];
	$client_job = $_POST['client_job'];
	$agent_code = $_POST['agent_code'];
	$update_total = 0;

	$plans = isset($_POST['planname']) ? $_POST['planname'] : [];

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
		$client_status = $_POST['client_status'];
		$new_plan = $_POST['planname'];


		$update_plan = [];
		foreach ($new_plan as $new_plans) {
			$query5 = "select * from takafulplan where plan_name='$new_plans'";
			$result5 = mysqli_query($con, $query5);

			$row5 = $result5->fetch_assoc();
			$price = $row5["plan_price"];
			$update_total += $price;
			$update_plan[] = $new_plans;
		}

		$update_plans = implode(", ", $update_plan);

		$query4 = "update quotation set client_IC='$client_IC', client_name='$client_name', client_age='$client_age', client_job='$client_job', client_phone='$client_phone', client_status='$client_status', selected_plan='$update_plans', agent_code='$agent_code', price='$update_total' where quotation_ID=$quotation_ID";
		mysqli_query($con, $query4);

		echo '<script>
	        window.location.href="client_quotation.php";
	        alert("Your quotation is updated !");
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
	<title>Client Edit Quotation</title>
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

	<form action="client_edit.php" method="POST">

		<div class="step-title">Step 1</div>
		<div class="step1">

			<input type="hidden" name="quotation_ID" value="<?= $quotation_ID ?>">

			<div class="client-info">
				<input type="text" name="client_IC" required="" placeholder="(eg. 000000-00-0000)"
					value="<?= $client_IC ?>">
				<label class="client-info-label">NRIC </label>
			</div>

			<div class="client-info">
				<input type="text" name="client_name" required="" value="<?= $client_name ?>">
				<label class="client-info-label">FULL NAME </label>
			</div>

			<div class="client-info">
				<input type="number" name="client_age" min="1" required="" value="<?= $client_age ?>">
				<label class="client-info-label">AGE </label>
			</div>

			<div class="client-info">
				<input type="text" name="client_job" required="" value="<?= $client_job ?>">
				<label class="client-info-label">JOB </label>
			</div>

			<div class="client-info">
				<input type="text" name="client_phone" required="" placeholder="(eg. 000-0000000)"
					value="<?= $client_phone ?>">
				<label class="client-info-label">PHONE </label>
			</div>

			<div class="radio-button-container">
				<div class="radio-button">
					<input type="radio" class="radio-button-input" id="radio1" name="client_status" value="Smoker" <?php if ((isset($_POST['client_status']) && $_POST['client_status'] === 'Smoker') || (isset($client_status) && $client_status === 'Smoker')) {
						echo 'checked';
					} ?>>
					<label class="radio-button-label" for="radio1">
						<span class="radio-button-circle"></span>
						Smoker
					</label>
				</div>
				<div class="radio-button">
					<input type="radio" class="radio-button-input" id="radio2" name="client_status" value="Non-smoker"
						<?php if ((isset($_POST['client_status']) && $_POST['client_status'] === 'Non-smoker') || (isset($client_status) && $client_status === 'Non-smoker')) {
							echo 'checked';
						} ?>>
					<label class="radio-button-label" for="radio2">
						<span class="radio-button-circle"></span>
						Non-smoker
					</label>
				</div>

			</div>
		</div>


		<div class="step-title">Step 2</div>

		<div class="step2">

			<?php

			while ($row3 = $result3->fetch_assoc()) {
				$checked = in_array($row3['plan_name'], $plans) ? 'checked' : '';
				echo "
				<div class='card-container'>
  				<div class='plan-card'>
    			<input class='plan-checkbox' type='checkbox' name='planname[]' value='$row3[plan_name]' $checked>
    			<span class='check'></span>
    			<label class='checkbox-label'>
      			<div class='checkbox-title'>$row3[plan_name]</div>
    			</label>
  				</div>
  				</div>
  				<br>
					";
			}

			?>

		</div>
		</div>


		<div class="step-title">Step 3</div>

		<div class="step3">

			<?php

			$query2 = "select * from agent";
			$result2 = mysqli_query($con, $query2);

			while ($row2 = $result2->fetch_assoc()) {
				$checkedAgent = $agent_code === $row2['agent_code'] ? 'checked' : '';

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





</body>

</html>