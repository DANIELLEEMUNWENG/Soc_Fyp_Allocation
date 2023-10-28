<?php
@include('config.php'); // Include the database configuration file

if (isset($_POST['listTopics']) && isset($_POST['code'])) {
 
    $listTopics = $_POST['listTopics'];
    $code = $_POST['code'];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statements to prevent SQL injection
    $sqlupdate = "UPDATE tbl_topic SET listTopics = ?, code = ? WHERE code = ?";
    $stmt = $conn->prepare($sqlupdate);
    $stmt->bind_param("sss", $listTopics, $code, $code);

    if ($stmt->execute()) {
        echo "Topic updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>SOC FYP ALLOCATION SYSTEM</title>
   <link rel="stylesheet" type="text/css" href="style/styles.css">
</head>
<body>
<div class="header">
   <h4>SOC FYP ALLOCATION SYSTEM</h4>
   <a href="logout.php" class="btn">Logout</a>
</div>
<div class="clear"></div>

<div class="container">
   <link href="style/taskbar.css" rel="stylesheet" type="text/css">
   <div class="topnav">
      <a class="active" href="supervisor.php">Home</a>
      <a href="supAdd.php">Add</a>
      <a href="supUpdate.php">Update</a>
   </div>
</div>
<form action="" method="post">
    <label for="code"> Code:</label>
    <input type="text" name="code">
    <br>
    
    <label for="listTopics">New Topic:</label>
    <textarea name="listTopics" rows="5" cols="40"></textarea>
    <br>
    <input type="submit" value="Update Topic">
</form>
</body>
</html>
