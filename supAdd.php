<?php
@include 'config.php';

if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}
// Collect topic information and supervisor_id from the form
$listTopics = $_POST['listTopics'];
$supervisor_id = $_POST['supervisor_id'];
$topic_id=$_POST['topic_id'];
// Verify that the supervisor_id exists in tbl_supervisor
$check_query = "SELECT id FROM tbl_supervisor WHERE id = '$supervisor_id'";
$check_result = $conn->query($check_query);

if ($check_result->num_rows > 0) {
    // The supervisor_id exists, so insert the topic into tbl_topic
    $insert_query = "INSERT INTO tbl_topic (listTopics,topic_id, supervisor_id) VALUES ('$listTopics','$topic_id', '$supervisor_id')";
    
    if ($conn->query($insert_query) === TRUE) {
        echo "Topic added successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Supervisor with ID $supervisor_id does not exist.";
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>SOC FYP ALLOCATION SYSTEM</title>
   <link rel="stylesheet" type="text/css" href="style/styles.css">
   <link rel="stylesheet" type="text/css" href="style/custom.css">
</head>
<body>
<div class="container">
   <link href="style/taskbar.css" rel="stylesheet" type="text/css">
   <div class="header">
      <h4>SOC FYP ALLOCATION SYSTEM</h4>
      <a href="logout.php" class="btn">logout</a>
   </div>
   <div class="clear"></div>

   <div class="topnav">
      <a class="active" href="supervisor.php">Home</a>
      <a href="supAdd.php">Add</a>
      <a href="supUpdate.php">Update</a>
   </div>
   <form action="" method="post">
   Topic ID: <input type="text" name="topic_id"><br>
    Topic: <br>
    <textarea name="listTopics" rows="5" cols="40"></textarea><br>
    Supervisor ID: <input type="text" name="supervisor_id">
    <input type="submit" value="Add Topic">
</form>

</div>
</body>
</html>
