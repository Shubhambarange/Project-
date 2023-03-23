<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task </title>
</head>
<body>
<form action="add_task.php" method="post">
  <div class="form-group">
    <label for="user_id">Select User:</label>
    <select class="form-control" id="user_id" name="user_id">
      <?php
        // Fetch all the users from the database
        $users = mysqli_query($conn, "SELECT * FROM users");
        
        // Loop through each user and display it as an option in the dropdown
        while ($row = mysqli_fetch_array($users)) {
          echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="task_detail">Task Detail:</label>
    <textarea class="form-control" id="task_detail" name="task_detail"></textarea>
  </div>
  <div class="form-group">
    <label for="task_status">Task Type:</label>
    <select class="form-control" id="task_status" name="task_status">
      <option value="New">New</option>
      <option value="In Progress">In Progress</option>
      <option value="Completed">Completed</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Add Task</button>
</form>

</body>
</html>