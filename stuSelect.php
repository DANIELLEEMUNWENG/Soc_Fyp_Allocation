<?php
@include 'config.php';

if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}
session_start();



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['select_topic'])) {
    $student_id = $_SESSION['student_id']; // You should have a session variable for student ID
    $selectedTopicId = $_POST['selected_topic_id'];
    if (!isset($_SESSION['student_id'])) {
        // Redirect if user is not logged in
        header("Location: login.php"); // Change 'login.php' to the appropriate login page
        exit();
    }

    // Insert the selected topic into the tbl_topic_selection table
    $insertSql = "INSERT INTO tbl_topic_selection (student_id, listTopics) VALUES (?, ?)";
    $stmt = $conn->prepare($insertSql);

    if ($stmt) {
        $stmt->bind_param("is", $student_id, $selectedTopicId);

        if ($stmt->execute()) {
            echo "Topic selection successful.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}

// SQL query to select data from the tbl_topic table
$sql = "SELECT * FROM tbl_topic";
$result = $conn->query($sql);
if (!$result) {
    echo "Error: " . $conn->error;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>SOC FYP ALLOCATION SYSTEM </title>
   <link rel="stylesheet" type="text/css" href="style/styles.css">
<div class="header">
   <h4> SOC FYP ALLOCATION SYSTEM</h4>
  
   <a href="logout.php" class="btn">logout</a>
</div>
<div class="clear"></div>
<style>
table, th,td {
   
   border: 2px solid black;
  border-collapse: collapse;
  width: 50%;
  text-align: left;
  padding: 8px;
}
table.center {
  margin-left: auto; 
  margin-right: auto;
}

tr:nth-child(even) {
  background-color: #D6EEEE;
}
</style>
</head>
<body>
   
<div class="container">
   <link href="style/taskbar.css" rel="stylesheet" type="text/css">

<div class="topnav">
  <a class="active" href="student.php">Home</a>
  <a href="stuSelect.php">Select</a>
  <a href="stuView.php">View</a>

</div>

</div>
<table class="center">
            <tr>
                <th style="width:7%">Code</th>
                <th> List of Topics </th>
                
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php 
                // LOOP TILL END OF DATA
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $rows['topic_id'];?></td>
                <td><?php echo $rows['listTopics'];?></td>
                <td>
                <form method="post" action="">
                    <input type="hidden" name="selected_topic_id" value="<?php echo $rows['listTopics']; ?>">
                    <button type="submit" name="select_topic">Select</button>
                </form>

                </td>
                
            </tr>
            <?php
                }
            ?>
        </table>
</body>
</html>