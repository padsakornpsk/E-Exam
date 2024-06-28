    <?php
    
    require("../E-Exam/config/config.php");

    // Check if bookingID is set and valid
    if (isset($_GET['fullname']) && !empty($_GET['fullname']) && isset($_GET['dateLeave']) && !empty($_GET['dateLeave'])) {
        $fullname = $_GET['fullname'];
        $dateLeave = $_GET['dateLeave'];

        // Query to fetch leave request data
        $selectLeaveRequestSQL = "SELECT * FROM leaverequest WHERE fullname = '$fullname' AND dateLeave = '$dateLeave'";
        $selectLeaveRequestQuery = mysqli_query(
            $conn,
            $selectLeaveRequestSQL
        );
        if (!$selectLeaveRequestQuery) {
            die('Query failed: ' . mysqli_error($conn));
        }

        // Fetch leave request data
        $leaveRequestData = mysqli_fetch_assoc($selectLeaveRequestQuery);
    } else {
        // Redirect to leave list if fullname or dateLeave are not provided
        header("Location: leaveList.php");
        exit();
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>แก้ไขข้อมูลการลา</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </head>

    <body>
        <?php
        include "menu.php"

        ?>
        <div class="container">
            <h2 class="mt-4">แก้ไขข้อมูลการลา</h2>
            <div class="row mt-3">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ข้อมูลการลา</h5>
                            <p><strong>ชื่อ-นามสกุล:</strong> <?php echo $leaveRequestData['fullname']; ?></p>
                            <p><strong>วันที่ขอลา - ถึงวันที่:</strong> <?php echo $leaveRequestData['dateLeave'] . ' - ' . $leaveRequestData['toDateLeave']; ?></p>


                            <p><strong>สถานะปัจจุบัน:</strong>
                                <?php
                                if ($leaveRequestData['status'] === '0') {
                                    echo 'รอพิจารณา';
                                } elseif ($leaveRequestData['status'] === '1') {
                                    echo 'อนุมัติ';
                                } elseif ($leaveRequestData['status'] === '2') {
                                    echo 'ไม่อนุมัติ';
                                } else {
                                    echo 'ไม่ระบุ';
                                }
                                ?>
                            </p>

                            <form action="updateStatus.php" method="POST">
                                <input type="hidden" name="fullname" value="<?php echo $leaveRequestData['fullname']; ?>">
                                <input type="hidden" name="dateLeave" value="<?php echo $dateLeave; ?>"> <!-- เพิ่มฟิลด์ dateLeave ที่รับค่าจากตัวแปร $dateLeave -->
                                <?php
                                if ($leaveRequestData['status'] === '0') :
                                ?>
                                    <div class="mb-3">
                                        <label for="statusSelect" class="form-label">เปลี่ยนสถานะเป็น:</label>
                                        <select class="form-select" id="statusSelect" name="newStatus">
                                            <option value="0" <?php echo $leaveRequestData['status'] === '0' ? 'selected' : ''; ?>>รอพิจารณา</option>
                                            <option value="1" <?php echo $leaveRequestData['status'] === '1' ? 'selected' : ''; ?>>อนุมัติ</option>
                                            <option value="2" <?php echo $leaveRequestData['status'] === '2' ? 'selected' : ''; ?>>ไม่อนุมัติ</option>
                                        </select>

                                    </div>
                                    <button type="submit" class="btn btn-primary">บันทึกการเปลี่ยนแปลง</button>
                                <?php endif ?>
                            </form>
                            <form action="deleteLeave.php" method="POST" onsubmit="return confirm('คุณต้องการลบข้อมูลการลานี้?');">
                                <input type="hidden" name="fullname" value="<?php echo $leaveRequestData['fullname']; ?>">
                                <input type="hidden" name="dateLeave" value="<?php echo $dateLeave; ?>">
                                <button type="submit" class="btn btn-danger mt-3">ลบข้อมูลการลา</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>

    </html>