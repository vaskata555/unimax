<?php
require_once 'templates/header.php';
?>
<?php
$verificationToken = $_GET['token'];

// Fetch the user based on the verification token
$query = "SELECT * FROM users1 WHERE verification_token = ?";
$stmt = mysqli_prepare($db, $query);

// Bind the parameter
mysqli_stmt_bind_param($stmt, "s", $verificationToken);

// Execute the statement
mysqli_stmt_execute($stmt);

// Get the result
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    // Update the verification status to mark the email as verified
    $updateQuery = "UPDATE users1 SET verified = 1 WHERE id = ?";
   
    $updateStmt = mysqli_prepare($db, $updateQuery);

    // Bind the parameter
    mysqli_stmt_bind_param($updateStmt, "i", $user['id']);

    // Execute the statement
    mysqli_stmt_execute($updateStmt);
    echo 'Email verification successful. Your email is now verified.';
} else {
    echo 'Invalid verification token. Please try again.';
}
mysqli_stmt_close($stmt);
mysqli_stmt_close($updateStmt);
?>
<?php
require_once 'templates/footer.php';
?>
