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
	<title>Client</title>
	<link rel="stylesheet" href="style.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

	<header id="header">

		<a href="admin_menu.php" class="FWD"><img src="kazlegacy-logo.png" alt="FWD" width="100" height="30"></a>

		<nav class="navbar">
			<a href="admin_menu.php">Menu</a>
			<a href="agent_admin.php">Agent</a>
			<a class="active" href="client_admin.php">Client</a>
			<a href="plan_admin.php">Plan</a>
			<a href="quotation_admin.php">Quotation</a>
		</nav>

		<div class="admin_logout">
			<a href="admin_logout.php" class="logout-button">Logout</a>
		</div>

	</header>

	<div class="admin-client-title">List of Client</div>

	<div class="admin-table-container">

		<div class="table-top">
			<div></div>
			<div class="search-bar-admin">
				<i class='bx bx-search'></i>
				<input type="text" name="search" id="searchClientAdmin" placeholder="Search">
			</div>
		</div>

		<div id="clientTableAdmin">

			<?php

			$query = "select * from client";
			$result = mysqli_query($con, $query);

			if (mysqli_num_rows($result) == 0) {
				echo "<span class='no-client-admin'>No record found !</span>";
			} else {
				echo "<table class='client-table'>
					<thead>
						<th>CLIENT ID</th>
						<th>CLIENT EMAIL</th>
						<th>CLIENT USERNAME</th>
						<th>CLIENT PASSWORD</th>
					</thead>";

				while ($row = $result->fetch_assoc()) {
					$client_ID = $row["client_ID"];
					$client_email = $row["client_email"];
					$client_username = $row["client_username"];
					$client_password = $row["client_password"];

					echo "
						<tr>
							<td>$client_ID</td>
							<td>$client_email</td>
							<td>$client_username</td>
							<td>$client_password</td>
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


		var searchClientAdmin = document.getElementById('searchClientAdmin');
		var clientTableAdmin = document.getElementById('clientTableAdmin');

		searchClientAdmin.addEventListener('keyup', function () {

			var xhr = new XMLHttpRequest();

			xhr.onreadystatechange = function () {
				if (xhr.readyState == 4 && xhr.status == 200) {
					clientTableAdmin.innerHTML = xhr.responseText;
				}
			}

			xhr.open('GET', 'search_client_admin.php?searchClientAdmin=' + searchClientAdmin.value, true);
			xhr.send();


		});
	</script>




</body>

</html>