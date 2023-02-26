<?php require_once 'dbConfig.php'; ?>

<?php
$username1 = "SELECT * FROM users1 WHERE username = $username";
if (isset($_SESSION['sessionId'])) {
    echo $_SESSION['username'];
    
        echo "You are logged in!";

    } else {
        echo "Home";
    }
    ?>