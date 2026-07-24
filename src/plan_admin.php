<?php

include "dbConfig.php";

session_start();

$admin_name = $_SESSION['admin_name'];

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Plan</title>
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
			<a class="active" href="plan_admin.php">Plan</a>
			<a href="quotation_admin.php">Quotation</a>
		</nav>

		<div class="admin_logout">
			<a href="admin_logout.php" class="logout-button">Logout</a>
		</div>

	</header>

	<div class="admin-plan-title">List of Plan</div>

	<div class="admin-table-container">

		<div class="table-top">
			<a href="add_plan.php" class="add-button">Add Plan</a>
			<div class="search-bar-admin">
				<i class='bx bx-search'></i>
				<input type="text" name="search" id="searchPlanAdmin" placeholder="Search">
			</div>
		</div>

		<div id="planTableAdmin">

			<?php

			$query = "select * from takafulplan";
			$result = mysqli_query($con, $query);

			if (mysqli_num_rows($result) == 0) {
				echo "<span class='no-plan-admin'>No record found !</span>";
			} else {
				echo "<table class='plan-table'>
				<thead>
					<th>PLAN NAME</th>
					<th>PLAN DESCRIPTION</th>
					<th>PLAN PRICE</th>
					<th>ACTION</th>
				</thead>";

				while ($row = $result->fetch_assoc()) {
					$plan_name = $row["plan_name"];
					$plan_description = $row["plan_description"];
					$plan_price = $row["plan_price"];

					echo "
					<tr>
					<td>$plan_name</td>
					<td>$plan_description</td>
					<td>RM$plan_price</td>
					<td class='admin-action'><a href='edit_plan.php?plan_name=$plan_name'><i class='bx bx-edit'></i></a><a onclick='confirmation(\"$plan_name\")' href='delete_plan.php?plan_name=$plan_name'><i class='bx bx-trash'></i></a></td>
					</tr>";
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


		function confirmation(plan_name) {
			var result = confirm('Do you really want to delete plan "' + plan_name + '"?');
			if (result == false) {
				event.preventDefault();
			}
		}


		var searchPlanAdmin = document.getElementById('searchPlanAdmin');
		var planTableAdmin = document.getElementById('planTableAdmin');

		searchPlanAdmin.addEventListener('keyup', function () {

			var xhr = new XMLHttpRequest();

			xhr.onreadystatechange = function () {
				if (xhr.readyState == 4 && xhr.status == 200) {
					planTableAdmin.innerHTML = xhr.responseText;
				}
			}

			xhr.open('GET', 'search_plan_admin.php?searchPlanAdmin=' + searchPlanAdmin.value, true);
			xhr.send();

		});
	</script>




</body>

</html>