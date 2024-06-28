<?php
require("../E-Exam/config/config.php");

// Retrieve search keyword from GET parameter
$searchKeyword = $_GET['searchKeyword'] ?? '';
$filter = $_GET['filter'];

// Query to fetch leave requests matching the search criteria
$selectLeaveRequestSQL = "SELECT * FROM leaverequest WHERE fullname LIKE '%$searchKeyword%' OR dateLeave LIKE '%$searchKeyword%' ORDER BY dateTimeRec $filter";
$selectLeaveRequestQuery = mysqli_query($conn, $selectLeaveRequestSQL);

if (!$selectLeaveRequestQuery) {
    die('Query failed: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการการลา (ผลการค้นหา)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include "menu.php"
    ?>
    <div class="container">
        <h2 class="mt-4">รายการการลา</h2>
        <div class="row">
            <div class="col">
                <form action="searchLeave.php" method="GET">
                    <div class="mb-3">
                        <label for="searchKeyword" class="form-label">ค้นหาตามชื่อ - นามสกุล, วันที่ขอลา</label>
                        <input type="text" class="form-control" id="searchKeyword" name="searchKeyword">
                        <div class="col">
                            <select Name="filter" required>
                                <option value="DESC" selected>เรียงจากน้อยไปมาก</option>
                                <option value="ASC">เรียงจากมากไปน้อย</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">ค้นหา</button>
                </form>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ชื่อ-นามสกุล</th>
                            <th scope="col">สังกัด/ตำแหน่ง</th>
                            <th scope="col">อีเมล์</th>
                            <th scope="col">เบอร์โทรศัพท์</th>
                            <th scope="col">ประเภทการลา</th>
                            <th scope="col">สาเหตุการลา</th>
                            <th scope="col">วันที่ขอลา - ถึงวันที่</th>
                            <th scope="col">วันเวลาที่บันทึกข้อมูล</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($selectLeaveRequestQuery)) { ?>
                            <tr>
                                <td><?php echo $row['fullname']; ?></td>
                                <td><?php echo $row['position']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['tel']; ?></td>
                                <td>
                                    <?php
                                    if ($row['leaveType'] === '1') {
                                        echo 'ลาป่วย';
                                    } elseif ($row['leaveType'] === '2') {
                                        echo 'ลากิจ';
                                    } elseif ($row['leaveType'] === '3') {
                                        echo 'พักร้อน';
                                    } else {
                                        echo 'อื่นๆ';
                                    }
                                    ?>
                                </td>

                                <td><?php echo $row['reasonLeave']; ?></td>
                                <td><?php echo $row['dateLeave'] . ' - ' . $row['toDateLeave']; ?></td>
                                <td><?php echo $row['dateTimeRec']; ?></td>
                                <td>
                                    <?php
                                    if ($row['status'] === '0') {
                                        echo 'รอพิจารณา';
                                    } elseif ($row['status'] === '1') {
                                        echo 'อนุมัติ';
                                    } elseif ($row['status'] === '2') {
                                        echo 'ไม่อนุมัติ';
                                    } else {
                                        echo 'ไม่ระบุ';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="editLeave.php?fullname=<?php echo $row['fullname']; ?>&dateLeave=<?php echo $row['dateLeave']; ?>" class="btn btn-info" role="button">จัดการ</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>