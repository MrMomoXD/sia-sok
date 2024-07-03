<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('HTTP/1.1 403 Forbidden');
    exit();
}

include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $parent_id = $_POST['parent_id'] ? $_POST['parent_id'] : null;

    $query = "INSERT INTO sections (name, description, parent_id) VALUES ('$name', '$description', ". ($parent_id ? $parent_id : 'NULL') .")";
    if (mysqli_query($conn, $query)) {
        header('HTTP/1.1 201 Created');
    } else {
        header('HTTP/1.1 500 Internal Server Error');
    }
}