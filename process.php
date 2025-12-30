<?php
$conn = new mysqli('localhost', 'root', '', 'libary_management');

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $title = $conn->real_escape_string($_POST['title']);
    $author = $conn->real_escape_string($_POST['author']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);
    $isbn = $conn->real_escape_string($_POST['isbn']);

    if ($action == 'add') {
        $conn->query("INSERT INTO books (title, author, email, phone, address, isbn) VALUES ('$title', '$author', '$email', '$phone', '$address', '$isbn')");
    } elseif ($action == 'edit') {
        $id = $_POST['id'];
        $conn->query("UPDATE books SET title='$title', author='$author', email='$email', phone='$phone', address='$address', isbn='$isbn' WHERE id=$id");
    }
}
header("location: index.php");
exit;
?>