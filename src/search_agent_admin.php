<?php

include "dbConfig.php";

session_start();

$admin_name = $_SESSION['admin_name'];

$searchAgentAdmin = $_GET['searchAgentAdmin'];

		$query = "select * from agent 
          	where agent_code LIKE '%$searchAgentAdmin%' OR 
              agent_name LIKE '%$searchAgentAdmin%' OR 
              agent_password LIKE '%$searchAgentAdmin%'";
		$result = mysqli_query($con,$query);

		if (mysqli_num_rows($result) == 0) 
		{
			echo "<span class='no-agent-admin'>No record found !</span>";
		}
		else
			{
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

				while($row = $result -> fetch_assoc())
				{
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