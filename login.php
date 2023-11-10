<?php
@include 'config.php';

session_start();

if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);

    $sql = "SELECT * FROM tbl_student WHERE email = '$email' AND password = '$pass'
   UNION
   SELECT * FROM tbl_coordinator WHERE email = '$email' AND password = '$pass'
   UNION
   SELECT * FROM tbl_supervisor WHERE email = '$email' AND password = '$pass'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        // Retrieve the user's auto-generated student_id from the database
        $user_id = $row['student_id'];

        if ($row['user_type'] == 'Supervisor') {
            $_SESSION['Supervisor_name'] = $row['name'];
            // Set the user's ID in the session
            $_SESSION['supervisor_id'] = $row['id'];
            header('location: supervisor.php');
        } elseif ($row['user_type'] == 'Student') {
            $_SESSION['Student_name'] = $row['name'];
            // Set the user's ID in the session
            $_SESSION['student_id'] = $row['id'];
            header('location: student.php');
        } elseif ($row['user_type'] == 'Coordinator') {
            $_SESSION['Coordinator_name'] = $row['name'];
            // Set the user's ID in the session
            $_SESSION['coordinator_id'] = $row['id'];
            header('location: coordinator.php');
        }
    } else {
        $error[] = 'Incorrect email or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style/login.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>don't have an account? <a href="register.php">register now</a></p>
   </form>

</div>

</body>
</html>