<?php
  // Include the database connection file
  include('db.php');
  
  // Get the form data
  $user_id = $_POST['user_id'];
  $task_detail = $_POST['task_detail'];
  $task_status = $_POST['task_status'];
  
  // Insert the task data into the database
  $query = "INSERT INTO tasks (user_id, task_detail, task_status) VALUES ('$user_id', '$task_detail', '$task_status')";
  mysqli_query($conn, $query);
  
  // Redirect to the tasks page
  header('Location: tasks.php');
?>
