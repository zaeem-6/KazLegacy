<?php

include "dbConfig.php";

session_start();

$admin_name = $_SESSION['admin_name'];

$searchClientAdmin = $_GET['searchClientAdmin'];

		$query = "select * from client
		where client_email LIKE '%$searchClientAdmin%' OR 
        client_username LIKE '%$searchClientAdmin%' OR 
        client_password LIKE '%$searchClientAdmin%' OR
        client_ID LIKE '%$searchClientAdmin%'";
		$result = mysqli_query($con,$query);

		if (mysqli_num_rows($result) == 0) 
		{
			echo "<span class='no-client-admin'>No record found !</span>";
		}
		else
		{
			echo "<table class='client-table'>
			<thead>
				<th>CLIENT ID</th>
				<th>CLIENT EMAIL</th>
				<th>CLIENT USERNAME</th>
				<th>CLIENT PASSWORD</th>
			</thead>";

			while($row = $result -> fetch_assoc())
			{
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