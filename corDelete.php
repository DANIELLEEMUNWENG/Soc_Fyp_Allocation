<?php
@include 'config.php';

if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

// SQL query to select data from the database
$sql = "SELECT * FROM tbl_topic";
$result = $conn->query($sql);

if ($result === FALSE) {
    die("Error executing the SQL query: " . $conn->error);
}

// Check if a specific code is provided for deletion
// Check if a specific code is provided for deletion
if (isset($_GET['listTopics'])) {
    $listTopics = $_GET['listTopics'];

    // Sanitize the code to prevent SQL injection
    $code = mysqli_real_escape_string($conn, $listTopics); // Pass $conn as the first argument

    // SQL query to delete the record where "listTopics" is equal to 'listTopics'
    $deleteSql = "DELETE FROM tbl_topic WHERE listTopics = '$code'";

    if ($conn->query($deleteSql) === TRUE) {
        echo "Record with topic '$listTopics' deleted successfully.";
    } else {
        echo "Error deleting record with topic '$listTopics': " . $conn->error;
    }
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
  <a class="active" href="coordinator.php">Home</a>
  <a href="corSelect.php">Results</a>
  <a href="corView.php">View</a>
  <a href="corAssign.php">Assign</a>
  <a href="corDelete.php">Delete</a>
</div>

</div>

<table class="center">
            <tr>
                <th style="width:7%">Supervisor Id</th>
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
                <td><?php echo $rows['supervisor_id'];?></td>
                <td><?php echo $rows['listTopics'];?></td>
                <!-- Add a Delete button to each row -->
                <td>
            <a href="?listTopics=<?php echo $rows['listTopics']; ?>">Delete</a>
        </td>
            </tr>
            <?php
                }
            ?>
        </table>

</body>
</html>