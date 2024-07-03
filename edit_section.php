<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('HTTP/1.1 403 Forbidden');
    exit();
}

include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $query = "UPDATE sections SET name='$name', description='$description' WHERE id=$id";
    if (mysqli_query($conn, $query)) {
        header('HTTP/1.1 200 OK');
    } else {
        header('HTTP/1.1 500 Internal Server Error');
    }
}
