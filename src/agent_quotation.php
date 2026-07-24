<?php

include "dbConfig.php";

date_default_timezone_set('Asia/Kuala_Lumpur');
session_start();

$agent_code = $_SESSION['agent_code'];

$query = "select * from quotation where agent_code='$agent_code'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

if (isset($_GET['quotation_ID']) && isset($_GET['progress'])) {
	$quotation_ID = $_GET['quotation_ID'];
	$progress = $_GET['progress'];


	if ($progress == "Pending") {
		$complete_date = "N/A";
	} else {
		$complete_date = date('d-m-y h:i:s');
	}

	$query2 = "update quotation set complete_date='$complete_date', progress='$progress' where quotation_ID='$quotation_ID'";
	$result2 = mysqli_query($con, $query2);
	header("location:agent_quotation.php");
}
?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Agent Quotation</title>
	<link rel="stylesheet" href="style.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

	<header id="header">

		<a href="agent_menu.php" class="FWD"><img src="kazlegacy-logo.png" alt="FWD" width="100" height="30"></a>

		<nav class="navbar">
			<a href="agent_menu.php">Menu</a>
			<a class="active" href="agent_quotation.php">Quotation</a>
			<a href="agent_profile.php">Profile</a>
		</nav>

		<div class="agent_logout">
			<a href="agent_logout.php" class="logout-button">Logout</a>
		</div>

	</header>

	<div class="your-quotation">
		<div class="your-quotation-title">Your Quotation</div>
		<div class="search-bar-agent">
			<i class='bx bx-search'></i>
			<input type="text" name="search" id="searchQuotationAgent" placeholder="Search">
		</div>
	</div>
	<hr>


	<div id="agentQuotationTable">

		<?php

		$query = "select * from quotation where agent_code='$agent_code'";
		$result = mysqli_query($con, $query);

		if (mysqli_num_rows($result) == 0) {
			echo "<span class='no-quotation-agent'>No quotation !</span>";
		} else {
			echo "<table class='agent-quotation-table'>
			<thead>
				<th>ID</th>
				<th>NRIC</th>
				<th>NAME</th>
				<th>AGE</th>
				<th>JOB</th>
				<th>PHONE</th>
				<th>STATUS</th>
				<th>PLAN</th>
				<th>AGENT</th>	
				<th>PROGRESS</th>
				<th>ACTION</th>	
			</thead>";

			while ($row = $result->fetch_assoc()) {
				$quotation_ID = $row["quotation_ID"];
				$client_IC = $row["client_IC"];
				$client_name = $row["client_name"];
				$client_age = $row["client_age"];
				$client_job = $row["client_job"];
				$client_phone = $row["client_phone"];
				$client_status = $row["client_status"];
				$selected_plan = $row["selected_plan"];
				$agent_code = $row["agent_code"];
				$progress = $row["progress"];

				if ($progress == "Pending") {
					echo "
					<tr>
					<td># $quotation_ID</td>
					<td>$client_IC</td>
					<td>$client_name</td>
					<td>$client_age</td>
					<td>$client_job</td>
					<td>$client_phone</td>
					<td>$client_status</td>
					<td>$selected_plan</td>
					<td>$agent_code</td>
					<td><p class='pending-bg'>$progress</p></td>
					<td class='action-column'><select class='option' onChange='update_progress(this.options[this.selectedIndex].value,$quotation_ID)'><option value=''>Update</option><option value='Pending'>Pending</option><option value='Completed'>Completed</option></select>
					<a onclick='confirmation($quotation_ID)' href='agent_delete_quotation.php?quotation_ID=$quotation_ID'><i class='bx bx-trash'></i></a></td>
				</tr>";
				} else {
					echo "
					<tr>
					<td># $quotation_ID</td>
					<td>$client_IC</td>
					<td>$client_name</td>
					<td>$client_age</td>
					<td>$client_job</td>
					<td>$client_phone</td>
					<td>$client_status</td>
					<td>$selected_plan</td>
					<td>$agent_code</td>
					<td><p class='completed-bg'>$progress</p></td>
					<td class='action-column'><select class='option' onChange='update_progress(this.options[this.selectedIndex].value,$quotation_ID)'><option value=''>Update</option><option value='Pending'>Pending</option><option value='Completed'>Completed</option></select>
					<a onclick='confirmation($quotation_ID)' href='agent_delete_quotation.php?quotation_ID=$quotation_ID'><i class='bx bx-trash'></i></a></td>
					</tr>";
				}

			}
			echo "</table>";
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



		function confirmation(quotation_ID) {
			var result = confirm('Do you really want to delete the quotation #' + quotation_ID + ' ?');
			if (result == false) {
				event.preventDefault();
				console.log(quotation_ID);
			}
		}



		function update_progress(value, quotation_ID) {
			let url = "agent_quotation.php";
			window.location.href = url + "?quotation_ID=" + quotation_ID + "&progress=" + value;
		}


		var searchQuotationAgent = document.getElementById('searchQuotationAgent');
		var agentQuotationTable = document.getElementById('agentQuotationTable');

		searchQuotationAgent.addEventListener('keyup', function () {

			var xhr = new XMLHttpRequest();

			xhr.onreadystatechange = function () {
				if (xhr.readyState == 4 && xhr.status == 200) {
					agentQuotationTable.innerHTML = xhr.responseText;
				}
			}

			xhr.open('GET', 'search_quotation_agent.php?searchQuotationAgent=' + searchQuotationAgent.value, true);
			xhr.send();


		});


	</script>

</body>

</html>