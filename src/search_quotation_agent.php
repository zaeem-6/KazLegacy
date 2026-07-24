<?php

include "dbConfig.php";

session_start();

$agent_code = $_SESSION['agent_code'];

$searchQuotationAgent = $_GET['searchQuotationAgent'];

		$query = "select * from quotation 
          where (client_IC LIKE '%$searchQuotationAgent%' OR 
                 client_name LIKE '%$searchQuotationAgent%' OR 
                 client_age LIKE '%$searchQuotationAgent%' OR 
                 client_job LIKE '%$searchQuotationAgent%' OR 
                 client_phone LIKE '%$searchQuotationAgent%' OR 
                 client_status LIKE '%$searchQuotationAgent%' OR 
                 selected_plan LIKE '%$searchQuotationAgent%' OR 
                 agent_code LIKE '%$searchQuotationAgent%' OR 
                 complete_date LIKE '%$searchQuotationAgent%' OR 
                 progress LIKE '%$searchQuotationAgent%' OR 
                 price LIKE '%$searchQuotationAgent%') AND 
                 agent_code = '$agent_code'";
		$result = mysqli_query($con,$query);

		if (mysqli_num_rows($result) == 0) 
		{
			echo "<span class='no-quotation-agent'>No record found !</span>";
		}
		else
		{
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
				$progress = $row["progress"];

				if($progress == "Pending")
				{
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
				}
				else
				{
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