
<?php include_once('admin_dashboard.php');?>  
<?php
// Connect to database



 // Check connection
 if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query the users table

$id = $_GET["id"];
// If the query returns results, display them in a table


// Close the connection


// Get user information from the database
$sql = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($db, $sql);
$user = mysqli_fetch_assoc($result);

// Check if the form is submitted
if (isset($_POST["submit"])) {
  // Get updated user information from the form
  $username = $_POST["username"];
  $email = $_POST["email"];

  // Update user information in the database
  $sql = "UPDATE users1 SET username = '$username', email = '$email' WHERE id = $id";
  mysqli_query($db, $sql);
}