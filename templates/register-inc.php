<?php

if (isset($_POST['submit'])) {
    //Add database connection
    require 'dbConfig.php';
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPass = $_POST['confirmPassword'];

    if (empty($username) || empty($password) || empty($confirmPass) || empty($email)) {
        header("Location: ../register.php?error=emptyfields&username=".$username);
        exit();
    } elseif (!preg_match("/^[a-zA-Z0-9]*/", $username)) {
        header("Location: ../register.php?error=invalidusername&username=".$username);
        exit();
    } elseif($password !== $confirmPass) {
        header("Location: ../register.php?error=passwordsdonotmatch&username=".$username);
        exit();
    }elseif (strlen($email) > 30 || strlen($email) <= 5) {
        header("Location: ../register.php?error=invalidemailtooshortortoolong=");
        exit();
    }elseif (strlen($username) > 16 || strlen($username) <= 4) {
        header("Location: ../register.php?error=invalidusernametooshort&username=".$username);
        exit();
    } elseif (strlen($password) > 20 || strlen($password) <= 8) {
        header("Location: ../register.php?error=invalidpasswordtooshort&password=");
        exit();
    }elseif  (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         
            header("Location: ../register.php?error=invalidemail&email=".$email);
            exit();
          
        
        
    }
    else {
        $sql = "SELECT username FROM users1 WHERE username = ?";
        $stmt = mysqli_stmt_init($db);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../register.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $rowCount = mysqli_stmt_num_rows($stmt);

            if ($rowCount > 0) {
                header("Location: ../register.php?error=usernametaken");
                exit();
            } else {
                $type = "user";
                $sql = "INSERT INTO users1 (email, username, password,type) VALUES (? ,? ,? ,? )";
                $stmt = mysqli_stmt_init($db);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../register.php?error=sqlerror");
                    exit();
                } else {
                    $hashedPass = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "ssss",$email, $username, $hashedPass,$type);
                    mysqli_stmt_execute($stmt);
                        header("Location: ../register.php?succes=registered");
                        exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($db);
}
?>

