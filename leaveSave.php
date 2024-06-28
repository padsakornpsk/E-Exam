<?php
require("../E-Exam/config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $position = $_POST['position'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $leave_types_value = $_POST['leave_types'];
    $reason_leave = $_POST['reason_leave'];
    $date_leave = new DateTime($_POST['date_leave']);
    $date_leave_to = new DateTime($_POST['date_leave_to']);
    $rec_date = new DateTime($_POST['rec_date']);
    $status = $_POST['status'];

    // ตรวจสอบเงื่อนไขว่าไม่อนุญาติให้บันทึกวันลาย้อนหลัง
    $today = new DateTime();
    if ($date_leave < $today || $date_leave_to < $today) {
        echo "<script>alert('ไม่อนุญาติให้บันทึกวันลาย้อนหลัง');window.location.href = 'leave_request.php';</script>";
        exit();
    }

    if ($leave_types_value === '3') {
        date_default_timezone_set("Asia/Bangkok");

        // หาความแตกต่างของวัน
        $leaveAdvance = $rec_date->diff($date_leave);
        $leaveNoMore = $date_leave->diff($date_leave_to);

        if ($leaveAdvance->days < 3) {
            echo "<script>alert('ต้องลาล่วงหน้าอย่างน้อย 3 วัน');window.location.href = 'leave_request.php';</script>";
            exit();
        } elseif ($leaveNoMore->days > 2) {
            echo "<script>alert('พักร้อนลาติดต่อกันได้ไม่เกิน 2 วัน');window.location.href = 'leave_request.php';</script>";
            exit();
        } else {
            // ทำสิ่งอื่นๆ ที่ต้องการตามต้องการ
        }
    }
    $sql = "INSERT INTO `leaverequest` (`fullname`, `position`, `email`, `tel`, `leaveType`, `reasonLeave`, `dateLeave`, `toDateLeave`, `dateTimeRec`, `status`)
            VALUES ('$fullname', '$position', '$email', '$tel', '$leave_types_value', '$reason_leave', '" . $date_leave->format('Y-m-d') . "', '" . $date_leave_to->format('Y-m-d') . "', '" . $rec_date->format('Y-m-d H:i:s') . "', '$status')";

    // ทำการ query และตรวจสอบการ query
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว');window.location.href = 'leave_request.php';</script>";
    } else {
        echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . mysqli_error($conn);
    }

    mysqli_close($conn); // ปิดการเชื่อมต่อฐานข้อมูล

}
