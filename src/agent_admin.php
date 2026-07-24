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
	<title>Agent</title>
	<link rel="stylesheet" href="style.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

	<header id="header">

		<a href="admin_menu.php" class="FWD"><img src="kazlegacy-logo.png" alt="FWD" width="100" height="30"></a>

		<nav class="navbar">
			<a href="admin_menu.php">Menu</a>
			<a class="active" href="agent_admin.php">Agent</a>
			<a href="client_admin.php">Client</a>
			<a href="plan_admin.php">Plan</a>
			<a href="quotation_admin.php">Quotation</a>
		</nav>

		<div class="admin_logout">
			<a href="admin_logout.php" class="logout-button">Logout</a>
		</div>

	</header>

	<div class="admin-agent-title">List of Agent</div>

	<div class="admin-table-container">

		<div class="table-top">
			<a href="add_agent.php" class="add-button">Add Agent</a>
			<div class="search-bar-admin">
				<i class='bx bx-search'></i>
				<input type="text" name="search" id="searchAgentAdmin" placeholder="Search">
			</div>
		</div>

		<div id="agentTableAdmin">

			<?php

			$query = "select * from agent";
			$result = mysqli_query($con, $query);

			if (mysqli_num_rows($result) == 0) {
				echo "<span class='no-agent-admin'>No record found !</span>";
			} else {
				echo "<table class='agent-table'>
				<thead>
					<th>Agent Code</th>
					<th>Agent Picture</th>
					<th>Agent Name</th>
					<th>Agent Password</th>
					<th>Agent Phone</th>
					<th>Agent Email</th>
					<th>Action</th>
				</thead>";

				while ($row = $result->fetch_assoc()) {
					$agent_code = $row["agent_code"];
					$agent_name = $row["agent_name"];
					$agent_password = $row["agent_password"];
					$agent_phone = $row["agent_phone"];
					$agent_email = $row["agent_email"];
					$agent_picture = $row["agent_picture"];

					echo "
					<tr>
					<td>$agent_code</td>
					<td><img src=$agent_picture></td>
					<td>$agent_name</td>
					<td>$agent_password</td>
					<td>$agent_phone</td>
					<td>$agent_email</td>
					<td class='admin-action'><a href='edit_agent.php?agent_code=$agent_code'><i class='bx bx-edit'></i></a>
					<a onclick='confirmation(\"$agent_code\")' href='delete_agent.php?agent_code=$agent_code'><i class='bx bx-trash'></i></a></td>
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


		function confirmation(agent_code) {
			var result = confirm('Do you really want to delete agent #' + agent_code + ' ?');
			if (result == false) {
				event.preventDefault();
			}
		}


		var searchAgentAdmin = document.getElementById('searchAgentAdmin');
		var agentTableAdmin = document.getElementById('agentTableAdmin');

		searchAgentAdmin.addEventListener('keyup', function () {

			var xhr = new XMLHttpRequest();

			xhr.onreadystatechange = function () {
				if (xhr.readyState == 4 && xhr.status == 200) {
					agentTableAdmin.innerHTML = xhr.responseText;
				}
			}

			xhr.open('GET', 'search_agent_admin.php?searchAgentAdmin=' + searchAgentAdmin.value, true);
			xhr.send();

		});

	</script>




</body>

</html>