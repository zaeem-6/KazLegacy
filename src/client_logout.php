<?php

session_start();
session_unset();
session_destroy();

echo '<script>
		window.location.href="client_login.php";
		alert("You have logged out!");
		</script>';
		exit();


?>