<?php

@include 'config.php';

// Start session
session_start();

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];

    // Check if the user already exists in the corresponding table based on user type
    $select = "SELECT * FROM tbl_user WHERE email = '$email'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'User already exists!';
    } else {
        if ($pass != $cpass) {
            $error[] = 'Password not matched!';
        } else {
            // Insert the user into the appropriate table based on user type
            if ($user_type === 'Student') {
                $insert = "INSERT INTO tbl_student (name, email, password, user_type) VALUES ('$name', '$email', '$pass','$user_type')";
            } elseif ($user_type === 'Coordinator') {
                $insert = "INSERT INTO tbl_coordinator (name, email, password, user_type) VALUES ('$name', '$email', '$pass', '$user_type')";
            } elseif ($user_type === 'Supervisor') {
                $insert = "INSERT INTO tbl_supervisor (name, email, password, user_type) VALUES ('$name', '$email', '$pass',  '$user_type')";
            } else {
                $error[] = 'Invalid user type';
            }

            if (isset($insert)) {
                mysqli_query($conn, $insert);

                // Get the auto-generated ID
                $user_id = mysqli_insert_id($conn);

                // Set session variables
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_type'] = $user_type;

                // Redirect to the login page or any other page as needed
                header('location: login.php');
            }
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style/register.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="enter your name">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <select name="user_type">
         <option value="Student">Student</option>
         <option value="Supervisor">Supervisor</option>
         <option value="Coordinator">Coordinator</option>
      </select>
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</div>

</body>
</html>