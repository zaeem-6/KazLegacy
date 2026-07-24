<?php

include "dbConfig.php";

session_start();

$agent_code = $_SESSION['agent_code'];

$query = "select * from agent where agent_code='$agent_code'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

$agent_name = $row["agent_name"];
$agent_phone = $row["agent_phone"];
$agent_email = $row["agent_email"];
$agent_password = $row["agent_password"];
$agent_picture = $row["agent_picture"];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$agent_name = $_POST["agent_name"];
	$agent_phone = $_POST["agent_phone"];
	$agent_email = $_POST["agent_email"];
	$agent_password = $_POST["agent_password"];

	if (is_numeric($agent_name)) {
		echo '<script>alert("Name must contain alphabet only !")</script>';
	} elseif (strlen($agent_password) < 5) {
		echo '<script>alert("Password should be at least 5 characters long!")</script>';
	} elseif (!filter_var($agent_email, FILTER_VALIDATE_EMAIL)) {
		echo '<script>alert("Email is invalid !")</script>';
	} elseif (!preg_match("/^0(?:[1-9]-\d{7,8}|[1-9]\d{1}-\d{7,8})$/", $agent_phone)) {
		echo '<script>alert("Phone is invalid !")</script>';
	} else {
		$checkEmail = "select * from agent where agent_email='$agent_email' and agent_code!='$agent_code'";
		$resultEmail = mysqli_query($con, $checkEmail);

		if (mysqli_num_rows($resultEmail) > 0) {
			echo '<script>alert("Email is already being used!")</script>';
		} else {
			if ($_FILES['image']['error'] == 4) {
				$query = "update agent set agent_name='$agent_name', agent_password='$agent_password', agent_phone='$agent_phone', agent_email='$agent_email' where agent_code='$agent_code'";
				$result = mysqli_query($con, $query);

				if ($result) {
					echo '<script>
              		  window.location.href="agent_profile.php";
              		  alert("Agent data has been updated !");
              		  </script>';
					exit();
				} else {
					echo '<script>alert("Error updating data in the database !")</script>';
				}
			} else {
				$image_name = $_FILES['image']['name'];
				$image_size = $_FILES['image']['size'];
				$tmp_name = $_FILES['image']['tmp_name'];

				$valid_image_extension = ['jpg', 'jpeg', 'png'];
				$image_extension = explode('.', $image_name);
				$image_extension = strtolower(end($image_extension));

				if (!in_array($image_extension, $valid_image_extension)) {
					echo '<script>alert("Cannot upload this type of file !")</script>';
				} elseif ($image_size > 1000000) {
					echo '<script>alert("File size is too big !")</script>';
				} else {
					$upload_dir = 'upload/';
					$new_image_name = uniqid() . '.' . $image_extension;
					$upload_file = $upload_dir . $new_image_name;

					if (move_uploaded_file($tmp_name, $upload_file)) {
						$query = "update agent set agent_name='$agent_name', agent_picture='$upload_file', agent_password='$agent_password', agent_phone='$agent_phone', agent_email='$agent_email' where agent_code='$agent_code'";
						$result = mysqli_query($con, $query);

						if ($result) {
							echo '<script>
	        			  window.location.href="agent_profile.php";
	        			  alert("Agent data has been updated !");
	        			  </script>';
							exit();
						} else {
							echo '<script>
	        			  window.location.href="agent_profile.php";
	        			  alert("Updating agent data unsuccessful !");
	        			  </script>';
							exit();
						}
					}
				}
			}
		}
	}
}

?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Agent Edit Profile</title>
	<link rel="stylesheet" href="style.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

	<header id="header">

		<a href="agent_menu.php" class="FWD"><img src="kazlegacy-logo.png" alt="FWD" width="100" height="30"></a>

		<nav class="navbar">
			<a href="agent_menu.php">Menu</a>
			<a href="agent_quotation.php">Quotation</a>
			<a href="agent_profile.php">Profile</a>
		</nav>

		<div class="agent_logout">
			<a href="agent_logout.php" class="logout-button">Logout</a>
		</div>

	</header>

	<div class="agent-edit-profile-container">

		<form action="agent_edit_profile.php" enctype="multipart/form-data" method="POST">

			<input type="hidden" name="agent_code" required="" value="<?= $agent_code ?>">

			<div class="edit-agent-info">
				<input type="text" name="agent_name" required="" value="<?= $agent_name ?>">
				<label class="agent-info-label">AGENT NAME</label>
			</div>

			<div class="edit-agent-info">
				<input type="text" name="agent_password" required="" value="<?= $agent_password ?>">
				<label class="agent-info-label">AGENT PASSWORD</label>
			</div>

			<div class="edit-agent-info">
				<input type="text" name="agent_email" required="" value="<?= $agent_email ?>">
				<label class="agent-info-label">AGENT EMAIL</label>
			</div>

			<div class="edit-agent-info">
				<input type="text" name="agent_phone" required="" value="<?= $agent_phone ?>">
				<label class="agent-info-label">AGENT PHONE</label>
			</div>

			<div class="edit-agent-picture">
				<input type="file" name="image" accept=".jpg, .jpeg, .png">
				<label class="agent-info-label">AGENT PICTURE</label>
			</div>

			<button class="update-button">UPDATE</button>

		</form>

	</div>


</body>

</html>