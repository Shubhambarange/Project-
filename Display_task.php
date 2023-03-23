<?php

// connect to database
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "password";
$dbname = "test_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// set pagination variables
$results_per_page = 10;
$page_number = 1;

if (isset($_GET['page'])) {
  $page_number = $_GET['page'];
}

// get total number of tasks
$sql = "SELECT COUNT(*) as total FROM tasks";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_tasks = $row['total'];

// calculate number of pages
$total_pages = ceil($total_tasks / $results_per_page);

// calculate offset
$offset = ($page_number - 1) * $results_per_page;

// select tasks with user data
$sql = "SELECT tasks.task_id, users.name as user_name, tasks.task_detail, tasks.task_status 
        FROM tasks 
        INNER JOIN users ON tasks.user_id = users.id 
        LIMIT $offset, $results_per_page";
$result = mysqli_query($conn, $sql);

// display tasks in a table
echo "<table>";
echo "<tr><th>Task ID</th><th>User Name</th><th>Task Detail</th><th>Task Status</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
  echo "<tr>";
  echo "<td>" . $row['task_id'] . "</td>";
  echo "<td>" . $row['user_name'] . "</td>";
  echo "<td>" . $row['task_detail'] . "</td>";
  echo "<td>" . $row['task_status'] . "</td>";
  echo "</tr>";
}
echo "</table>";

// display pagination links
echo "<div>";
for ($i = 1; $i <= $total_pages; $i++) {
  echo "<a href='tasks.php?page=$i'>$i</a>";
}
echo "</div>";

// close database connection
mysqli_close($conn);

?>
