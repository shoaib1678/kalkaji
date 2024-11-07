<?php
include_once "./header.php";
include_once "./config.php";
session_start();

if(!isset($_SESSION['sess_user_id'])) {
    header("Location: login.php");
    exit();
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete record
    $sql = "DELETE FROM result WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if($stmt->execute()) {
        header("Location: tables.php");
        exit();
    }
}
?>
