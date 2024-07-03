<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Content-Type: application/json');
    echo json_encode([]);
    exit();
}

include('db.php');

function getSections($parent_id = null) {
    global $conn;
    $query = "SELECT * FROM sections WHERE parent_id " . ($parent_id === null ? "IS NULL" : "= $parent_id");
    $result = mysqli_query($conn, $query);
    $sections = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $row['children'] = getSections($row['id']);
        $sections[] = $row;
    }
    return $sections;
}

$sections = getSections();
header('Content-Type: application/json');
echo json_encode($sections);
