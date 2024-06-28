<?php

require("../E-Exam/config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from POST request
    $fullname = $_POST['fullname'];
    $dateLeave = $_POST['dateLeave'];

    // Query to delete leave request
    $deleteLeaveSQL = "DELETE FROM leaverequest WHERE fullname = '$fullname' AND dateLeave = '$dateLeave'";
    $deleteLeaveQuery = mysqli_query($conn, $deleteLeaveSQL);

    if ($deleteLeaveQuery) {
        // Redirect to leave list after successful deletion
        header("Location: leaveList.php");
        exit();
    } else {
        // Handle deletion failure
        die('Failed to delete leave request: ' . mysqli_error($conn));
    }
} else {
    // Redirect if accessed directly without POST method
    header("Location: leaveList.php");
    exit();
}
