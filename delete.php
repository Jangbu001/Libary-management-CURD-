<?php
// 1. Establish connection to the Venus Library database
$conn = new mysqli('localhost', 'root', '', 'libary_management');

// 2. Check if the 'id' is passed in the URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // 3. Delete the record from the 'books' table
    $sql = "DELETE FROM books WHERE id=$id";
    $conn->query($sql);
}

// 4. Redirect back to the main inventory page
header("location: index.php");
exit;
?>