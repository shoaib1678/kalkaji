<?php
include_once "./header.php";
include_once "./config.php";
session_start();

if(!isset($_SESSION['sess_user_id'])) {
    header("Location: login.php");
    exit();
}

// SQL query to fetch data from the result table
$sql = "SELECT * FROM result ORDER BY `id` DESC";
$result = $conn->query($sql);
?>

<section class="tables">
    <h2>Tables</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>date</th>
                    <th>time</th>
                    <th>number</th>
                    
                    <th>old_number</th>
                    <th>created_at</th>
                                        <th>operation</th>

                  
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["date"] . "</td>";
                        echo "<td>" . $row["time"] . "</td>";
                        echo "<td>" . $row["number"] . "</td>";
                        echo "<td>" . $row["old_number"] . "</td>";
                        echo "<td>" . $row["created_at"] . "</td>";
                                                echo "<td> <a href='update.php?id=" . $row["id"] . "' class='operation'>update</a> <a href='delete.php?id=" . $row["id"] . "' class='operation'>Delete</a> </td>";

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No results found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</section>

<?php
// include_once "./footer.php";
?>
<script src="scripts.js"></script>
</body>
</html>
