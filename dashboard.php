<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="scripts.js" defer></script>
    <title>Dashboard</title>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Welcome, <?php echo $_SESSION['username']; ?></h1>
        <div id="tree" class="mt-4">
            <!-- Section tree will be loaded here -->
        </div>
        <div class="mt-3">
            <button class="btn btn-primary" onclick="addSection()">Add Section</button>
            <button class="btn btn-secondary" onclick="logout()">Logout</button>
        </div>
    </div>
</body>
</html>

