<?php

include "dbConfig.php";

if(isset($_GET['quotation_ID']))
{
	$quotation_ID = $_GET['quotation_ID'];

	$query = "delete from quotation where quotation_ID=$quotation_ID";
	mysqli_query($con,$query);

	echo '<script> 
			window.location.href = "agent_quotation.php";
			alert("Quotation has been deleted !")
			</script>';
	exit();
}


?>