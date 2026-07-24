<?php

include "dbConfig.php";

if(isset($_GET['agent_code']))
{
	$agent_code = $_GET['agent_code'];

	$query2 = "select * from quotation where agent_code='$agent_code'";
	$result = mysqli_query($con,$query2);
	$row = mysqli_num_rows($result);

	if($row == 0)
	{
		$query = "delete from agent where agent_code='$agent_code'";
		mysqli_query($con,$query);

		echo '<script> 
				window.location.href = "agent_admin.php";
				alert("Agent has been deleted !")
				</script>';
		exit();
	}
	else
	{
		echo '<script> 
				window.location.href = "agent_admin.php";
				alert("Agent cannot be deleted! Make sure agent is not assign to any quotation")
				</script>';
		exit();
	}


	
}


?>