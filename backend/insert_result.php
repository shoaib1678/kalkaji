<?php
require_once ('./config.php');

$lottery_number = str_pad($_POST['number'], 2, '0', STR_PAD_LEFT);

date_default_timezone_set('Asia/Kolkata');
$current_time = date("H:i:s");
$current_time = date('H:i:s', strtotime($current_time . ' + 1 hour'));
list($hours, $minutes, $seconds) = explode(":", $current_time);
$rounded_time = "$hours:00:00";

$sql = "INSERT INTO result (date, time, number, old_number)
SELECT CURRENT_DATE(), '$rounded_time', '$lottery_number', (
    SELECT number FROM (
        SELECT number FROM result WHERE date = CURRENT_DATE() - INTERVAL 1 DAY AND time = '$rounded_time' LIMIT 1
    ) AS old_number
)";
$query = $conn->query($sql);

if ($query) {
   header("location: ./tables.php");
} else {
    echo "Error: " . $conn->error;
}