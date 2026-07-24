<?php

include "dbConfig.php";

session_start();

$client_ID = $_SESSION['client_ID'];

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
			<a class="active" href="client_quotation.php">Quotation</a>
		</nav>

		<div class="client_logout">
			<a href="client_logout.php" class="logout-button">Logout</a>
		</div>

	</header>

	<div class="your-quotation">
		<div class="your-quotation-title">Your Quotation</div>
		<div class="search-bar-client">
			<i class='bx bx-search'></i>
			<input type="text" name="search" id="searchQuotationClient" placeholder="Search">
		</div>
	</div>
	<br>
	<hr>


	<div class="client-data-container" id="searchContainerClient">
		<?php

		$query = "select * from quotation where client_ID=$client_ID";
		$result = mysqli_query($con, $query);

		if (mysqli_num_rows($result) == 0) {
			echo "<span class='no-quotation'>No quotation recorded !</span>";
		} else {

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
				$est_price = $row["price"];
				$progress = $row["progress"];

				$query2 = "select * from agent where agent_code='$agent_code'";
				$result2 = mysqli_query($con, $query2);
				$row2 = mysqli_fetch_assoc($result2);

				$agent_name = $row2["agent_name"];

				if ($progress == "Pending") {
					echo "
				<div class='client_card'>

				<div class='card-top'>
				<div class='top-content1'><b>$client_IC</b></div>
				<div class='top-content2'><a href='#' class='pending'>$progress</a></div>
				</div>

				<div class='big-card-middle'>
				<div class='card-middle'>
				<div class='middle-content1'><p class='middle-title'>NAME</p>$client_name</div>
				<div class='middle-content2'><p class='middle-title'>AGE</p>$client_age</div>
				</div>

				<div class='card-middle'>
				<div class='middle-content1'><p class='middle-title'>JOB</p>$client_job</div>
				<div class='middle-content2'><p class='middle-title'>PHONE</p>$client_phone</div>
				</div>

				<div class='card-middle'>
				<div class='middle-content1'><p class='middle-title'>STATUS</p>$client_status</div>
				<div class='middle-content2'><p class='middle-title'>PLAN</p>$selected_plan</div>
				</div>

				<div class='card-middle'>
				<div class='middle-content1'><p class='middle-title'>AGENT</p>$agent_code - $agent_name</div>
				<div class='middle-content2'><p class='middle-title'>COMPLETED ON</p>$complete_date</div>
				</div>
				</div>

				<div class='card-bottom'>
				<div class='bottom-content1'><p class='bottom-title'><a href='client_edit.php?quotation_ID=$quotation_ID'><i class='bx bx-edit'></i></a></div>
				<div class='bottom-content2'><p class='bottom-title'><a onclick='confirmation()' href='client_delete.php?quotation_ID=$quotation_ID'><i class='bx bx-trash'></i></a></div>
				<div class='bottom-content4'><p class='bottom-title'><a href='client_view_quotation.php?quotation_ID=$quotation_ID'><i class='bx bx-show'></i></a></div>
				<div class='bottom-content3'><p class='bottom-title'><b>EST PRICE</b></p>RM$est_price/month</div>
				</div>

				</div>";
				} else {
					echo "
				<div class='client_card'>

				<div class='card-top'>
				<div class='top-content1'><b>$client_IC</b></div>
				<div class='top-content2'><a href='#' class='completed'>$progress</a></div>
				</div>

				<div class='big-card-middle'>
				<div class='card-middle'>
				<div class='middle-content1'><p class='middle-title'>NAME</p>$client_name</div>
				<div class='middle-content2'><p class='middle-title'>AGE</p>$client_age</div>
				</div>

				<div class='card-middle'>
				<div class='middle-content1'><p class='middle-title'>JOB</p>$client_job</div>
				<div class='middle-content2'><p class='middle-title'>PHONE</p>$client_phone</div>
				</div>

				<div class='card-middle'>
				<div class='middle-content1'><p class='middle-title'>STATUS</p>$client_status</div>
				<div class='middle-content2'><p class='middle-title'>PLAN</p>$selected_plan</div>
				</div>

				<div class='card-middle'>
				<div class='middle-content1'><p class='middle-title'>AGENT</p>$agent_code - $agent_name</div>
				<div class='middle-content2'><p class='middle-title'>COMPLETED ON</p>$complete_date</div>
				</div>
				</div>

				<div class='card-bottom'>
				<div class='cbottom-content1'><p class='bottom-title'><i class='bx bx-edit'></i></div>
				<div class='cbottom-content2'><p class='bottom-title'><i class='bx bx-trash'></i></div>
				<div class='cbottom-content4'><p class='bottom-title'><a href='client_view_quotation.php?quotation_ID=$quotation_ID'><i class='bx bx-show'></i></a></div>
				<div class='bottom-content3'><p class='bottom-title'><b>EST PRICE</b></p>RM$est_price/month</div>
				</div>

				</div>";
				}
			}
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



		function confirmation() {
			var result = confirm('Do you really want to delete the quotation ?');
			if (result == false) {
				event.preventDefault();
			}
		}



		var searchQuotationClient = document.getElementById('searchQuotationClient');
		var searchContainerClient = document.getElementById('searchContainerClient');

		searchQuotationClient.addEventListener('keyup', function () {

			var xhr = new XMLHttpRequest();

			xhr.onreadystatechange = function () {
				if (xhr.readyState == 4 && xhr.status == 200) {
					searchContainerClient.innerHTML = xhr.responseText;
				}
			}

			xhr.open('GET', 'search_quotation_client.php?searchQuotationClient=' + searchQuotationClient.value, true);
			xhr.send();


		});
	</script>


</body>

</html>