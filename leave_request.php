<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include "menu.php"
    ?>
    <form action="leaveSave.php" method="post">
        <div class="col">
            ชื่อ - นามสกุล
        </div>
        <div class="col">
            <input id="fullname" name="fullname" type="text" required>
        </div>


        <div class="col">
            สังกัด/ตำแหน่ง
        </div>
        <div class="col">
            <input id="position" name="position" type="text">
        </div>

        <div class="col">
            อีเมล์
        </div>
        <div class="col">
            <input id="email" name="email" type="email">
        </div>

        <div class="col">
            เบอร์โทรศัพท์
        </div>
        <div class="col">
            <input id="tel" name="tel" type="text" maxlength="10" required>
        </div>

        <div class="col">
            ประเภทการลา
        </div>
        <div class="col">
            <select Name="leave_types" required>
                <option value="1">ลาป่วย</option>
                <option value="2">ลากิจ</option>
                <option value="3">พักร้อน</option>
                <option selected value="0">อื่นๆ</option>
            </select>
        </div>

        <div class="col">
            สาเหตุการลา
        </div>
        <div class="col">
            <input id="reason_leave" name="reason_leave" type="text" required>
        </div>
        <div class="row">
            <div class="col-3">
                วันที่ขอลา
            </div>
            <div class="col-3">
                ถึงวันที่
            </div>
        </div>

        <div class="row">
            <div class="col-3">
                <input id="date_leave" name="date_leave" type="date" required>
            </div>
            <div class="col-3">
                <input id="date_leave_to" name="date_leave_to" type="date" required>
            </div>
        </div>

        <div class="col">
            วันเวลาที่บันทึกข้อมูล
        </div>
        <div class="row">
            <div class="col">
                <input id="rec_date" name="rec_date" type="text" value="<?php echo date("dd-mm-YY h:i:sa"); ?>" required>
            </div>
        </div>

        <div class="col" style="display:none">
            สถานะ
        </div>
        <div class="col">
            <select Name="status" required style="display: none;">
                <option value="0" selected>รอพิจารณา</option>
                <option value="1">อนุมัติ</option>
                <option value="2">ไม่อนุมัติ</option>
            </select>
        </div>
        <button>บันทึก</button>
    </form>


</body>

</html>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var now = new Date();
        var year = now.getFullYear();
        var month = ('0' + (now.getMonth() + 1)).slice(-2);
        var day = ('0' + now.getDate()).slice(-2);
        var hours = ('0' + now.getHours()).slice(-2);
        var minutes = ('0' + now.getMinutes()).slice(-2);
        var seconds = ('0' + now.getSeconds()).slice(-2);
        var currentDateTime = `${year}-${month}-${day}T${hours}:${minutes}:${seconds}`;
        document.getElementById('rec_date').value = currentDateTime;
    });
    document.addEventListener("DOMContentLoaded", function() {
        var now = new Date();
        var year = now.getFullYear();
        var month = ('0' + (now.getMonth() + 1)).slice(-2);
        var day = ('0' + now.getDate()).slice(-2);
        var currentDate = `${year}-${month}-${day}`;
        document.getElementById('date_leave').value = currentDate;
    });
</script>