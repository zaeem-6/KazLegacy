<?php

include "dbConfig.php";

session_start();

$admin_name = $_SESSION['admin_name'];

$query = "select * from quotation";
$result = mysqli_query($con, $query);

$query2 = "select * from agent";
$result2 = mysqli_query($con, $query2);

$dropdown_agent_code = array();
while ($row2 = $result2->fetch_assoc()) {
	$dropdown_agent_code[] = $row2["agent_code"];
}

if (isset($_GET['quotation_ID']) && isset($_GET['update_agent'])) {
	$quotation_ID = $_GET['quotation_ID'];
	$update_agent = $_GET['update_agent'];

	$query3 = "update quotation set agent_code='$update_agent' where quotation_ID='$quotation_ID'";
	$result3 = mysqli_query($con, $query3);
	header("location:quotation_admin.php");
}


?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Quotation</title>
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
			<a class="active" href="quotation_admin.php">Quotation</a>
		</nav>

		<div class="admin_logout">
			<a href="admin_logout.php" class="logout-button">Logout</a>
		</div>

	</header>

	<div class="admin-quotation-title">List of Quotation</div>

	<div class="admin-table-container">

		<div class="table-top">
			<div></div>
			<div class="search-bar-admin">
				<i class='bx bx-search'></i>
				<input type="text" name="search" id="searchQuotationAdmin" placeholder="Search">
			</div>
		</div>

		<div id="quotationTableAdmin">

			<?php

			if (mysqli_num_rows($result) == 0) {
				echo "<span class='no-quotation-admin'>No quotation recorded !</span>";
			} else {
				echo "<table class='quotation-table'>
				<thead>
					<th>NRIC</th>
					<th>NAME</th>
					<th>AGE</th>
					<th>JOB</th>
					<th>PHONE</th>
					<th>STATUS</th>
					<th>SELECTED PLAN</th>
					<th>AGENT CODE</th>
					<th>COMPLETE DATE</th>
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
					$complete_date = $row["complete_date"];
					$progress = $row["progress"];

					if ($progress == "Pending") {
						echo "
						<tr>
						<td>$client_IC</td>
						<td>$client_name</td>
						<td>$client_age</td>
						<td>$client_job</td>
						<td>$client_phone</td>
						<td>$client_status</td>
						<td>$selected_plan</td>
						<td>$agent_code</td>
						<td>$complete_date</td>
						<td><p class='pending-bg'>$progress</p></td>
						<td><select class='option' onChange='update_progress(this.options[this.selectedIndex].value,$quotation_ID)'><option value=''>Change Agent</option>";

						foreach ($dropdown_agent_code as $select_agent_code) {
							echo "<option value='$select_agent_code'>$select_agent_code</option>";
						}

						echo "</td></tr>";
					} else {
						echo "
						<tr>
						<td>$client_IC</td>
						<td>$client_name</td>
						<td>$client_age</td>
						<td>$client_job</td>
						<td>$client_phone</td>
						<td>$client_status</td>
						<td>$selected_plan</td>
						<td>$agent_code</td>
						<td>$complete_date</td>
						<td><p class='completed-bg'>$progress</p></td>
						<td><select class='option' onChange='update_progress(this.options[this.selectedIndex].value,$quotation_ID)'><option value=''>Change Agent</option>";

						foreach ($dropdown_agent_code as $select_agent_code) {
							echo "<option value='$select_agent_code'>$select_agent_code</option>";
						}

						echo "</td></tr>";
					}

				}
				echo "</table>";
			}

			?>
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


		function update_progress(value, quotation_ID) {
			let url = "quotation_admin.php";
			window.location.href = url + "?quotation_ID=" + quotation_ID + "&update_agent=" + value;
		}


		var searchQuotationAdmin = document.getElementById('searchQuotationAdmin');
		var quotationTableAdmin = document.getElementById('quotationTableAdmin');

		searchQuotationAdmin.addEventListener('keyup', function () {

			var xhr = new XMLHttpRequest();

			xhr.onreadystatechange = function () {
				if (xhr.readyState == 4 && xhr.status == 200) {
					quotationTableAdmin.innerHTML = xhr.responseText;
				}
			}

			xhr.open('GET', 'search_quotation_admin.php?searchQuotationAdmin=' + searchQuotationAdmin.value, true);
			xhr.send();

		});
	</script>




</body>

</html>