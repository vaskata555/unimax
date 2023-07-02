<?php 
 include('templates/header.php');

// Connect to database
 // Check connection
 if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
$id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);