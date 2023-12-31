<?php
@include 'config.php';

if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}
$sql = " SELECT * FROM tbl_topic_selection ";
$result = $conn->query($sql);


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
table, th, td {
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
th:nth-child(1),
      td:nth-child(1) {
         width: 5%; /* Adjust the width as needed */
      }

th:nth-child(3),
td:nth-child(3) {
  width: 5%; /* Adjust the width as needed */
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
                <th style="width:-50%">Student ID</th>
                <th> List of Topics  </th>
                <th> Supervisor ID  </th>

                
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
                <td><?php echo $rows['student_id'];?></td>
                <td><?php echo $rows['listTopics'];?></td>
                <td><?php echo $rows['supervisor_id'];?></td>

                
            </tr>
            <?php
                }
            ?>
        </table>
</body>
</html>