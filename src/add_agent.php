<?php
include "dbConfig.php";

session_start();

$admin_name = $_SESSION['admin_name'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $agent_code = $_POST['agent_code'];
  $agent_name = $_POST['agent_name'];
  $agent_password = $_POST['agent_password'];
  $agent_phone = $_POST['agent_phone'];
  $agent_email = $_POST['agent_email'];

  if (is_numeric($agent_name)) {
    echo '<script>alert("Name must contain alphabet only !")</script>';
  } elseif (strlen($agent_password) < 5) {
    echo '<script>alert("Password should be at least 5 characters long!")</script>';
  } elseif (!filter_var($agent_email, FILTER_VALIDATE_EMAIL)) {
    echo '<script>alert("Email is invalid !")</script>';
  } elseif (!preg_match("/^0(?:[1-9]-\d{7,8}|[1-9]\d{1}-\d{7,8})$/", $agent_phone)) {
    echo '<script>alert("Phone is invalid !")</script>';
  } else {
    $query2 = "select * from agent where agent_code='$agent_code'";
    $result2 = mysqli_query($con, $query2);

    if (mysqli_num_rows($result2) > 0) {
      echo '<script>alert("Agent Code is already being used!")</script>';
    } else {
      $checkEmail = "select * from agent where agent_email='$agent_email'";
      $resultEmail = mysqli_query($con, $checkEmail);

      if (mysqli_num_rows($resultEmail) > 0) {
        echo '<script>alert("Email is already being used!")</script>';
      } else {
        if ($_FILES['image']['error'] == 4) {
          $default_pic = 'upload/default_pic.jpg';
          $query = "insert into agent (agent_code, agent_name, agent_password, agent_email, agent_phone, agent_picture) VALUES ('$agent_code','$agent_name','$agent_password','$agent_email','$agent_phone','$default_pic')";
          $result = mysqli_query($con, $query);

          if ($result) {
            echo '<script>
              window.location.href="agent_admin.php";
              alert("New agent has been added !");
              </script>';
            exit();
          } else {
            echo '<script>alert("Error inserting data into the database.")</script>';
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
            $uploadDir = 'upload/';
            $new_image_name = uniqid() . '.' . $image_extension;
            $uploadFile = $uploadDir . $new_image_name;

            if (move_uploaded_file($tmp_name, $uploadFile)) {
              $query = "insert into agent (agent_code, agent_name, agent_password, agent_email, agent_phone, agent_picture) VALUES ('$agent_code','$agent_name','$agent_password','$agent_email','$agent_phone','$uploadFile')";
              $result = mysqli_query($con, $query);

              if ($result) {
                echo '<script>
                        window.location.href="agent_admin.php";
                        alert("New agent has been added !");
                        </script>';
                exit();
              } else {
                echo '<script>alert("Error inserting data into the database.")</script>';
              }
            } else {
              echo '<script>alert("File upload failed.")</script>';
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
  <title>Add Agent</title>
  <link rel="stylesheet" href="style.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

  <header id="header">

    <a href="home.php" class="FWD"><img
        src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/Logo_FWD.svg/2560px-Logo_FWD.svg.png" alt="FWD"
        width="100" height="30"></a>

    <nav class="navbar">
      <a href="admin_menu.php">Menu</a>
      <a href="agent_admin.php">Agent</a>
      <a href="client_admin.php">Client</a>
      <a href="plan_admin.php">Plan</a>
      <a href="quotation_admin.php">Quotation</a>
    </nav>

    <div class="admin_logout">
      <a href="admin_logout.php" class="logout-button">Logout</a>
    </div>

  </header>

  <div class="admin-agent-title-add-agent">Add New Agent</div>

  <div class="admin-table-container-add-agent">

    <form action="add_agent.php" method="POST" enctype="multipart/form-data">

      <div class="add-agent-info">
        <input type="text" name="agent_code" required=""
          value="<?php if (isset($_POST['agent_code'])) {
            echo $_POST['agent_code'];
          } ?>">
        <label class="agent-info-label">AGENT CODE</label>
      </div>

      <div class="add-agent-info">
        <input type="text" name="agent_name" required=""
          value="<?php if (isset($_POST['agent_name'])) {
            echo $_POST['agent_name'];
          } ?>">
        <label class="agent-info-label">AGENT NAME</label>
      </div>

      <div class="add-agent-info">
        <input type="text" name="agent_password" required=""
          value="<?php if (isset($_POST['agent_password'])) {
            echo $_POST['agent_password'];
          } ?>">
        <label class="agent-info-label">AGENT PASSWORD</label>
      </div>

      <div class="add-agent-info">
        <input type="text" name="agent_email" required=""
          value="<?php if (isset($_POST['agent_email'])) {
            echo $_POST['agent_email'];
          } ?>">
        <label class="agent-info-label">AGENT EMAIL</label>
      </div>

      <div class="add-agent-info">
        <input type="text" name="agent_phone" required=""
          value="<?php if (isset($_POST['agent_phone'])) {
            echo $_POST['agent_phone'];
          } ?>"
          placeholder="(eg. 000-0000000)">
        <label class="agent-info-label">AGENT PHONE</label>
      </div>

      <div class="add-agent-picture">
        <input type="file" name="image" accept=".jpg, .jpeg, .png">
        <label class="agent-info-label">AGENT IMAGE</label>
      </div>

      <button class="submit-button">ADD</button>

    </form>



  </div>



  <script>
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function () {
      var currentScrollPos = window.pageYOffset;
      if (prevScrollpos > currentScrollPos) {
        document.getElementById("header").style.top = "15px";
      } else {
        document.getElementById("header").style.top = "-13%";
      }
      prevScrollpos = currentScrollPos;
    }
  </script>




</body>

</html>