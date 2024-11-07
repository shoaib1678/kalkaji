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

    // Fetch current data
    $sql = "SELECT * FROM result WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $date = $_POST['date'];
        $time = $_POST['time'];
        $number = $_POST['number'];
        $old_number = $_POST['old_number'];

        // Update record
        $sql = "UPDATE result SET date=?, time=?, number=?, old_number=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssii", $date, $time, $number, $old_number, $id);
        if($stmt->execute()) {
            header("Location: tables.php");
            exit();
        }
    }
}
?>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<form method="post" action="" class="container shadow  justify-content-center w-50">
    <h3>Update Number</h3>
    Date: <input type="text" class="form-control" name="date" value="<?php echo $row['date']; ?>"><br>
    Time: <input type="text"  class="form-control" name="time" value="<?php echo $row['time']; ?>"><br>
    Number: <input type="text"  class="form-control" name="number" value="<?php echo $row['number']; ?>"><br>
    Old Number: <input type="text" name="old_number"  class="form-control" value="<?php echo $row['old_number']; ?>"><br>
    <input type="submit" value="Update" class="btn btn-primary">
</form>
</body>
<?php
include_once "./footer.php";
?>
