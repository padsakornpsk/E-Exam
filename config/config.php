<?php
$serverName = 'localhost';
$userName = 'root';
$userPassword = '';
$dbName = 'leave_request_system';
?>
<?php
$conn = @mysqli_connect($serverName, $userName, $userPassword, $dbName);
?>
<?php
if (!$conn) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว" . mysqli_connect_error($conn));
} else {
    @date_default_timezone_set('Asia/Bangkok');
    @mysqli_set_charset($conn, 'utf8');
    @mysqli_query($conn, 'SET NAMES UTF8');
}
?>
<?php
/**$strSQL='SELECT * FROM customer';
    $query = @mysqli_query($conn,$strSQL);  
    while($resultObj = @mysqli_fetch_array($query,MYSQLI_ASSOC)){
        print_r($resultObj);
    }
 */
?>