<?php

include "dbConfig.php";

session_start();

$admin_name = $_SESSION['admin_name'];

$searchPlanAdmin = $_GET['searchPlanAdmin'];

		$query = "select * from takafulplan
		where plan_name LIKE '%$searchPlanAdmin%' OR 
        plan_description LIKE '%$searchPlanAdmin%' OR 
        plan_price LIKE '%$searchPlanAdmin%'";
		$result = mysqli_query($con,$query);

		if (mysqli_num_rows($result) == 0) 
			{
				echo "<span class='no-plan-admin'>No record found !</span>";
			}
			else
			{
				echo "<table class='plan-table'>
				<thead>
					<th>PLAN NAME</th>
					<th>PLAN DESCRIPTION</th>
					<th>PLAN PRICE</th>
					<th>ACTION</th>
				</thead>";

				while($row = $result -> fetch_assoc())
				{
					$plan_name = $row["plan_name"];
					$plan_description = $row["plan_description"];
					$plan_price = $row["plan_price"];

					echo "
					<tr>
					<td>$plan_name</td>
					<td>$plan_description</td>
					<td>RM$plan_price</td>
					<td class='admin-action'><a href='edit_plan.php?plan_name=$plan_name'><i class='bx bx-edit'></i></a><a href='delete_plan.php?plan_name=$plan_name'><i class='bx bx-trash'></i></a></td>
					</tr>";
				}
				echo "</table>";
			}

			

?>