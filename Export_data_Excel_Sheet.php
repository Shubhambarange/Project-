<?php
// include PHPExcel library
require_once 'PHPExcel/PHPExcel.php';

// create new PHPExcel object
$objPHPExcel = new PHPExcel();

// create Users sheet
$objPHPExcel->getActiveSheet()->setTitle('Users');

// fetch users data from database
$usersData = array();
$conn = mysqli_connect('dbhost', 'dbuser', 'dbpass', 'dbname');
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $usersData[] = $row;
    }
}

// set Users sheet headers
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Name');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Email');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Mobile');

// fill Users sheet data
$rowNumber = 2;
foreach ($usersData as $userData) {
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowNumber, $userData['id']);
    $objPHPExcel->getActiveSheet()->setCellValue('B' . $rowNumber, $userData['name']);
    $objPHPExcel->getActiveSheet()->setCellValue('C' . $rowNumber, $userData['email']);
    $objPHPExcel->getActiveSheet()->setCellValue('D' . $rowNumber, $userData['mobile']);
    $rowNumber++;
}

// create Tasks sheet
$objPHPExcel->createSheet();
$objPHPExcel->getActiveSheet()->setTitle('Tasks');

// fetch tasks data from database
$tasksData = array();
$query = "SELECT tasks.*, users.name as user_name FROM tasks JOIN users ON tasks.user_id = users.id";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $tasksData[] = $row;
    }
}

// set Tasks sheet headers
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Task ID');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'User Name');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Task Detail');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Task Status');

// fill Tasks sheet data
$rowNumber = 2;
foreach ($tasksData as $taskData) {
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowNumber, $taskData['task_id']);
    $objPHPExcel->getActiveSheet()->setCellValue('B' . $rowNumber, $taskData['user_name']);
    $objPHPExcel->getActiveSheet()->setCellValue('C' . $rowNumber, $taskData['task_detail']);
    $objPHPExcel->getActiveSheet()->setCellValue('D' . $rowNumber, $taskData['task_status']);
    $rowNumber++;
}