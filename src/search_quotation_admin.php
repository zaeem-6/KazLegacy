<?php

include "dbConfig.php";

session_start();

$query2 = "select * from agent";
$result2 = mysqli_query($con,$query2);

$dropdown_agent_code = array();
while($row2 = $result2 -> fetch_assoc())
	{
		$dropdown_agent_code[] = $row2["agent_code"];
	}

$admin_name = $_SESSION['admin_name'];

$searchQuotationAdmin = $_GET['searchQuotationAdmin'];

		$query = "select * from quotation 
          	where client_IC LIKE '%$searchQuotationAdmin%' OR 
              client_name LIKE '%$searchQuotationAdmin%' OR 
              client_age LIKE '%$searchQuotationAdmin%' OR 
              client_job LIKE '%$searchQuotationAdmin%' OR 
              client_phone LIKE '%$searchQuotationAdmin%' OR 
              client_status LIKE '%$searchQuotationAdmin%' OR 
              selected_plan LIKE '%$searchQuotationAdmin%' OR 
              agent_code LIKE '%$searchQuotationAdmin%' OR 
              complete_date LIKE '%$searchQuotationAdmin%' OR 
              progress LIKE '%$searchQuotationAdmin%'";
		$result = mysqli_query($con,$query);

		if(mysqli_num_rows($result) == 0)
		{
			echo "<span class='no-quotation-admin'>No record found !</span>";
		}
		else
		{
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

			while($row = $result -> fetch_assoc())
			{
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

				if($progress == "Pending")
				{
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

					foreach($dropdown_agent_code as $select_agent_code)
					{
						echo "<option value='$select_agent_code'>$select_agent_code</option>";
					}

					echo "</td></tr>";
				}
				else
				{
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

					foreach($dropdown_agent_code as $select_agent_code)
					{
						echo "<option value='$select_agent_code'>$select_agent_code</option>";
					}

					echo "</td></tr>";
				}
				
			}
			echo "</table>";
		}

?>