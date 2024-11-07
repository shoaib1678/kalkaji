<?php
include '../config.php';
$year = $_POST['year'];
$type = $_POST['type'];
if ($year == "") {
    echo "Please provide year";
    return http_response_code(400);
}
if ($type == "") {
    echo "Please provide type";
    return http_response_code(400);
}
date_default_timezone_set('Asia/Kolkata');
$currentDate = date("Y-m-d");
$current_time = date("H:i:s");
if($type == 'monthly') {
    $sql = "SELECT date, time, number FROM result WHERE MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = '$year' AND (date < CURDATE() OR (date = CURDATE() AND time <= CURTIME()))";
}
else {
    $sql = "SELECT date, time, number FROM result WHERE YEAR(date) = '$year' AND (date < CURDATE() OR (date = CURDATE() AND time <= CURTIME()))";
}

$result = $conn->query($sql);
$daily_chart = [];
while ($row = $result->fetch_assoc()) {
    $date = $row['date'];
    $time = $row['time'];
    $number = $row['number'];

    if (!isset($daily_chart[$date])) {
        $daily_chart[$date] = [];
    }
    $daily_chart[$date][] = [
        "date" => $date,
        "time" => $time,
        "number" => $number
    ];
}

$daily_chart = array_values($daily_chart);
echo json_encode($daily_chart);