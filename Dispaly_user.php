<?php
//connect to database
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'password';
$dbname = 'test_db';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

//get total number of records in the table
$sql = "SELECT COUNT(id) AS total FROM users";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_records = $row['total'];

//number of records per page
$records_per_page = 10;

//calculate number of pages
$total_pages = ceil($total_records / $records_per_page);

//get current page number
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
  $current_page = $_GET['page'];
} else {
  $current_page = 1;
}

//calculate offset for the query
$offset = ($current_page - 1) * $records_per_page;

//retrieve records from database
$sql = "SELECT * FROM users LIMIT $offset, $records_per_page";
$result = mysqli_query($conn, $sql);

//display records in a table
echo "<table>";
echo "<tr><th>Name</th><th>Email</th><th>Mobile</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
  echo "<tr>";
  echo "<td>".$row['name']."</td>";
  echo "<td>".$row['email']."</td>";
  echo "<td>".$row['mobile']."</td>";
  echo "</tr>";
}
echo "</table>";

//display pagination links
echo "<div>";
echo "<ul>";
for ($i = 1; $i <= $total_pages; $i++) {
  echo "<li><a href='index.php?page=$i'>$i</a></li>";
}
echo "</ul>";
echo "</div>";

//close database connection
mysqli_close($conn);
?>

