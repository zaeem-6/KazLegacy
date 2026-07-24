<?php

include "dbConfig.php";

session_start();

$client_ID = $_SESSION['client_ID'];

$searchQuotationClient = $_GET['searchQuotationClient'];

		$query = "select * from quotation 
          where (client_IC LIKE '%$searchQuotationClient%' OR 
                 client_name LIKE '%$searchQuotationClient%' OR 
                 client_age LIKE '%$searchQuotationClient%' OR 
                 client_job LIKE '%$searchQuotationClient%' OR 
                 client_phone LIKE '%$searchQuotationClient%' OR 
                 client_status LIKE '%$searchQuotationClient%' OR 
                 selected_plan LIKE '%$searchQuotationClient%' OR 
                 agent_code LIKE '%$searchQuotationClient%' OR 
                 complete_date LIKE '%$searchQuotationClient%' OR 
                 progress LIKE '%$searchQuotationClient%' OR 
                 price LIKE '%$searchQuotationClient%') AND 
                 client_ID = '$client_ID'";
		$result = mysqli_query($con,$query);

		if(mysqli_num_rows($result) == 0)
		{
			echo "<span class='no-quotation'>No record found !</span>";
		}
		else
		{

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
			$est_price = $row["price"];
			$progress = $row["progress"];

			$query2 = "select * from agent where agent_code='$agent_code'";
			$result2 = mysqli_query($con,$query2);
			$row2 = mysqli_fetch_assoc($result2);

			$agent_name = $row2["agent_name"];

			if ($progress == "Pending")
			{
				echo"
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
				<div class='bottom-content2'><p class='bottom-title'><a onclick='confirmation()'href='client_delete.php?quotation_ID=$quotation_ID'><i class='bx bx-trash'></i></a></div>
				<div class='bottom-content4'><p class='bottom-title'><a href='client_view_quotation.php?quotation_ID=$quotation_ID'><i class='bx bx-show'></i></a></div>
				<div class='bottom-content3'><p class='bottom-title'><b>EST PRICE</b></p>RM$est_price/month</div>
				</div>

				</div>";
			}
			else
			{
				echo"
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
				<div class='bottom-content4'><p class='bottom-title'><a href='client_view_quotation.php?quotation_ID=$quotation_ID'><i class='bx bx-show'></i></a></div>
				<div class='bottom-content3'><p class='bottom-title'><b>EST PRICE</b></p>RM$est_price/month</div>
				</div>

				</div>";
			}
		}
	}

?>

<script>
	function confirmation() {
	var result = confirm('Are you sure?');
	if (result == false)
	{
		event.preventDefault();
	}
}
</script>