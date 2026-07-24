<?php

include "dbConfig.php";

require_once __DIR__ . '/vendor/autoload.php';

session_start();

$client_ID = $_SESSION['client_ID'];

if ($_SERVER['REQUEST_METHOD'] == "GET") 
{
	if (!isset($_GET['quotation_ID'])) 
	{
		header("Location: client_quotation.php");
		exit();
	}

	$quotation_ID = $_GET['quotation_ID'];

	$query = "select * from quotation where quotation_ID=$quotation_ID";
	$result = mysqli_query($con, $query);
	$row = $result -> fetch_assoc();

	if(!$row)
	{
		header("Location: client_quotation.php");
		exit();
	}

	$client_IC = $row["client_IC"];
	$client_name = $row["client_name"];
	$client_age = $row["client_age"];
	$client_job = $row["client_job"];
	$client_phone = $row["client_phone"];
	$client_status = $row["client_status"];
	$selected_plan = $row["selected_plan"];
	$agent_code = $row["agent_code"];

	$query2 = "select * from agent where agent_code='$agent_code'";
	$result2 = mysqli_query($con, $query2);
	$row2 = $result2 -> fetch_assoc();

	$agent_name = $row2["agent_name"];

	$price = $row["price"];
}
$html = '<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Download Quotation</title>
</head>

<body>

<div style="padding: 20px;">
		
		<p style="font-size: 30px;">FWD</p>
		<p style="margin-top: -30px;">No. 211, 29th Floor Menara Shell, Jalan Tun Sambanthan, 50470 Kuala Lumpur</p>

		<div style="border: 1px solid #C9C9C9; width: 100%;">
			<div style="position: relative; display: flex; justify-content: space-between; align-items: center; padding: 20px; background-color: #C9C9C9; font-size: 20px;">
				<div>QUOTATION ID #'. $quotation_ID .'</div>
				<div style="position: absolute; right: 10px; top: 7px"><b>EST PRICE <br>RM'. $price .'</b></div>
			</div>

			<div style="padding: 10px 20px 0 20px;">

				<p style="padding-left: 5px; color: grey;">NRIC</p>
				<p style="padding-left: 5px; padding-bottom: 7px; border-bottom: 1px solid #DCDCDC;">'. $client_IC .'</p>

				<p style="padding-left: 5px; color: grey;">NAME</p>
				<p style="padding-left: 5px; padding-bottom: 7px; border-bottom: 1px solid #DCDCDC;">'. $client_name .'</p>

				<p style="padding-left: 5px; color: grey;">AGE</p>
				<p style="padding-left: 5px; padding-bottom: 7px; border-bottom: 1px solid #DCDCDC;">'. $client_age .'</p>

				<p style="padding-left: 5px; color: grey;">JOB</p>
				<p style="padding-left: 5px; padding-bottom: 7px; border-bottom: 1px solid #DCDCDC;">'. $client_job .'</p>

				<p style="padding-left: 5px; color: grey;">PHONE</p>
				<p style="padding-left: 5px; padding-bottom: 7px; border-bottom: 1px solid #DCDCDC;">'. $client_phone .'</p>

				<p style="padding-left: 5px; color: grey;">STATUS</p>
				<p style="padding-left: 5px; padding-bottom: 7px; border-bottom: 1px solid #DCDCDC;">'. $client_status .'</p>

				<p style="padding-left: 5px; color: grey;">SELECTED PLAN</p>
				<p style="padding-left: 5px; padding-bottom: 7px; border-bottom: 1px solid #DCDCDC;">'. $selected_plan .'</p>

				<p style="padding-left: 5px; color: grey;">AGENT</p>
				<p style="padding-left: 5px; padding-bottom: 7px;">'. $agent_code .' - '. $agent_name .'</p>
				
			</div>
		</div>

	</div>

</body>
</html>';



use Dompdf\Dompdf;

$dompdf = new Dompdf();

$dompdf -> loadHTML($html);

$dompdf -> render();

$dompdf -> stream("fwdQuotation.pdf", ["Attachment" => 0]);

?>

