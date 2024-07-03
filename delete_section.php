<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('HTTP/1.1 403 Forbidden');
    exit();
}

include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $data);
    $id = $data['id'];

    if ($id) {
        $query = "DELETE FROM sections WHERE id=$id";
        if (mysqli_query($conn, $query)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid ID']);
    }
} else {
    header('HTTP/1.1 405 Method Not Allowed');
}
