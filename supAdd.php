<?php
@include('config.php');

$code = $_POST['code'];
$topic_name = $_POST['listTopics'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the 'code' value already exists in the database (excluding 0)
$checkSql = "SELECT code FROM tbl_topic WHERE code = '$code' OR (code = 0 AND '$code' = 0)";
$result = $conn->query($checkSql);

if ($result->num_rows == 0) {
    // 'code' is not in the database, so insert the new record
    $sql = "INSERT INTO tbl_topic (code, listTopics) VALUES ('$code', '$topic_name')";

    if ($conn->query($sql) === TRUE) {
        echo "Topic added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error: The 'code' value already exists in the database.";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>SOC FYP ALLOCATION SYSTEM</title>
   <link rel="stylesheet" type="text/css" href="style/styles.css">
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
      Code: <input type="text" name="code"><br>
      Topic: <br>
      <textarea name="listTopics" rows="5" cols="40"></textarea><br>
      <input type="submit" value="Add Topic">
   </form>
</div>
</body>
</html>
