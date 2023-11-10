<?php
@include 'config.php';

if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

// Collect updated topic information and topic_id from the form
$listTopics = $_POST['listTopics'];
$topic_id = $_POST['topic_id'];

// Check if the topic with the specified topic_id exists
$check_query = "SELECT topic_id FROM tbl_topic WHERE topic_id = '$topic_id'";
$check_result = $conn->query($check_query);

if ($check_result->num_rows > 0) {
    // The topic with the specified topic_id exists, so update the topic in tbl_topic
    $update_query = "UPDATE tbl_topic SET listTopics = '$listTopics' WHERE topic_id = '$topic_id'";
    
    if ($conn->query($update_query) === TRUE) {
        echo "Topic updated successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Topic with ID $topic_id does not exist.";
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
   <div class "header">
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
      Updated Topic: <br>
      <textarea name="listTopics" rows="5" cols="40"></textarea><br>
      <input type="submit" value="Update Topic">
   </form>
</div>
</body>
</html>
