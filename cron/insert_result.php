<?php
require_once('../backend/config.php');

$lottery_number = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);

date_default_timezone_set('Asia/Kolkata');
$current_time = date("H:i:s");
$new_time = date("H:i:s", strtotime("+1 hour", strtotime($current_time)));
list($hours, $minutes, $seconds) = explode(":", $new_time);
$rounded_time = "$hours:00:00";

echo $minutes;


// Check if the time is within the allowed range (10 AM to 11 PM)
if ($current_time > '09:00:00' && $current_time < '23:00:00') {
    if($minutes > 50 && $minutes <= 59) {
        $sql = "SELECT * FROM result WHERE date = CURRENT_DATE() AND time = '$rounded_time'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "Entry already updated";
        } else {
            // Insert new lottery number along with old number from the previous day
            $sql = "
                INSERT INTO result (date, time, number, old_number)
                SELECT CURRENT_DATE(), '$rounded_time', '$lottery_number', (
                    SELECT number 
                    FROM result 
                    WHERE date = CURRENT_DATE() - INTERVAL 1 DAY AND time = '$rounded_time' 
                    LIMIT 1
                ) AS old_number
            ";

            if ($conn->query($sql) === TRUE) {
                echo "Number inserted successfully: " . $lottery_number;
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }
    else {
        echo "Cron job runs only in last 10 minutes.";
    }
} else {
    echo "Cron job runs only between 10 AM and 11 PM.";
}
?>