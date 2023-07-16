<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['Student_name'])){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style/register.css">

</head>
<body>
   
<div class="container">

   <div class="content">
      <h3>hi, <span>Student</span></h3>
      <h1>welcome <span><?php echo $_SESSION['Student_name'] ?></span></h1>
      <p>this is an Student page</p>
      <a href="login.php" class="btn">login</a>
      <a href="register.php" class="btn">register</a>
      <a href="logout.php" class="btn">logout</a>
   </div>

</div>

</body>
</html>