
<?php
$servername = "localhost";
$username = "kalkajil_kalkaji";
$password = "MuU0y6mUP;(k"; 
$db = "kalkajil_kalkajil";
$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}