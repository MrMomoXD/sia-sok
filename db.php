<?php
$conn = mysqli_connect('localhost', 'root', '', 'section_tree');

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
