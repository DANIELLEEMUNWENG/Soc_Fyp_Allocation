<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['Coordinator_name'])){
   header('location:login.php');
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

</body>
</html>