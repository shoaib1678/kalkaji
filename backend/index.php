<?php
include_once "./header.php";
session_start();
if(!isset($_SESSION['sess_user_id'])) {
    header("Location: login.php");
}

?>
<head>
    <style>
        .form-section{
            display: grid;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    

</body>

<section class="form-section">
                <h2>Form Section</h2>
                <form id="myForm" action="./insert_result.php" method="post" >
                    <label for="number">Add Number</label>
                    <input type="text" id="number" name="number" required>
                    <button type="submit">Submit</button>
                </form>
            </section>

<?php
include_once "./footer.php";
?>