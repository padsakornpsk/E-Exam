<?php

require("../E-Exam/config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $dateLeave = $_POST['dateLeave']; // รับค่า dateLeave จากฟอร์ม
    $newStatus = $_POST['newStatus'];

    // Update status query
    $updateStatusSQL = "UPDATE leaverequest SET status = '$newStatus' WHERE fullname = '$fullname' AND dateLeave = '$dateLeave'";
    $updateStatusQuery = mysqli_query($conn, $updateStatusSQL);
    if (!$updateStatusQuery) {
        die('Query failed: ' . mysqli_error($conn));
    }

    // Redirect back to leave list after update
    header("Location: leaveList.php");
    exit();
} else {
    // Redirect if accessed directly without POST method
    header("Location: leaveList.php");
    exit();
}
