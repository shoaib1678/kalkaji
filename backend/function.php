<?php
function getLotteryResults( $conn){
global $conn;
$sql = "SELECT * FROM result";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

    }
}return $row;
}
?>
