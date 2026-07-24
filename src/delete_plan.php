<?php

include "dbConfig.php";

if(isset($_GET['plan_name']))
{
	$plan_name = $_GET['plan_name'];

	$query = "delete from takafulplan where plan_name='$plan_name'";
	mysqli_query($con,$query);

	echo '<script> 
			window.location.href = "plan_admin.php";
			alert("Plan has been deleted !")
			</script>';
	exit();
}


?>