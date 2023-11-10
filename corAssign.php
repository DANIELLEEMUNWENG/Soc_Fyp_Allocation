<?php
// Include your database configuration file
@include 'config.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start the session
session_start();
echo "it stops here (before session check)";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Form submitted!";
    $student_id = $_POST['student_id']; // Get the selected student's ID from the form
    $selected_topic = $_POST['selected_topic']; // Get the selected topic from the form

    if (!empty($student_id) && !empty($selected_topic)) {
        // Retrieve supervisor_id along with other data from tbl_topic
        $selectTopicSql = "SELECT listTopics, supervisor_id FROM tbl_topic WHERE listTopics = ?";
        $stmtSelect = $conn->prepare($selectTopicSql);

        if ($stmtSelect) {
            $stmtSelect->bind_param("s", $selected_topic);

            if ($stmtSelect->execute()) {
                $stmtSelect->store_result();
                $stmtSelect->bind_result($listTopics, $supervisor_id);

                // Fetch supervisor_id
                $stmtSelect->fetch();

                // Insert the assignment into the tbl_topic_selection table
                $insert_query = "INSERT INTO tbl_topic_selection (student_id, listTopics, supervisor_id, assigned) VALUES (?, ?, ?, 1)";
                
                // Execute the query
                $stmtInsert = $conn->prepare($insert_query);

                if ($stmtInsert) {
                    $stmtInsert->bind_param("iss", $student_id, $listTopics, $supervisor_id);

                    if ($stmtInsert->execute()) {
                        echo "Topic assigned successfully. Supervisor ID: $supervisor_id";
                        // You can also update the availability of the topic in the tbl_topic table here if needed
                    } else {
                        echo "Error: " . $stmtInsert->error;
                    }

                    $stmtInsert->close();
                } else {
                    echo "Error: " . $conn->error;
                }

                $stmtSelect->close();
            } else {
                echo "Error: " . $stmtSelect->error;
            }
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Please select a student and a topic.";
    }
} else {
    echo "Form not submitted.";
}

echo "it stops here (after form check)";
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
    form {
        max-width: 400px;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f5f5f5;
    }

    label {
        display: block;
        margin-bottom: 8px;
    }

    select, input {
        width: 100%;
        padding: 8px;
        margin-bottom: 12px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #4caf50;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
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

   <form method="post" action="">
       <label for="student_id">Select Student:</label>
       <select name="student_id">
       <?php
               // Retrieve a list of students from your database
               $student_query = "SELECT id FROM tbl_student"; // Adjust this query
               $student_result = $conn->query($student_query);

               if ($student_result->num_rows > 0) {
                   while ($row = $student_result->fetch_assoc()) {
                       echo "<option value='" . $row['id'] . "'>" . $row['id'] . "</option>";
                   }
               }
               ?>
       </select>

       <label for="selected_topic">Select Topic:</label>
       <select name="selected_topic">
       <?php
               // Retrieve a list of available topics from your database
               $topic_query = "SELECT listTopics FROM tbl_topic "; // Adjust this query
               $topic_result = $conn->query($topic_query);

               if ($topic_result->num_rows > 0) {
                   while ($row = $topic_result->fetch_assoc()) {
                       echo "<option value='" . $row['listTopics'] . "'>" . $row['listTopics'] . "</option>";
                   }
               }
               ?>
       </select>

       <input type="submit" value="Assign Topic">
   </form>
</div>
</body>
</html>
