<?php
session_start();
if (isset($_POST['submit'])) {

    require 'dbConfig.php'; 
    
    
    

    $username = $_POST['username'];
    $password = $_POST['password'];
   
    
    if (empty($username) || empty($password)) {
        header("Location: ../login.php?error=emptyfields");
        $_SESSION['error'] = "Моля, попълнете всички задължителни полета.";
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_stmt_init($db);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
           
            if ($row = mysqli_fetch_assoc($result)) {
                $passCheck = password_verify($password, $row['password']);
               $verified = $row['verified'];
                if ($passCheck == false) {
                    header("Location: ../login.php?error=wrongpass");
                    $statusMsg ="Грешна парола";
                    exit();
                } elseif ($passCheck == true) {
                    if($verified=='1'){
                    session_start();
                    $_SESSION['sessionId'] = $row['id'];
                 $_SESSION['sessionUser'] = $row['username'];
                 $_SESSION['sessionUsertype'] = $row['type'];
                
                    header("Location: ../login.php?success=loggedin");
                    $_SESSION['error'] = "Успешно влизане.";
                    exit();
                    }else{ header("Location: ../login.php?error=notverified");
                        $_SESSION['error'] = "Акаунтът не е потвърден.Моля проверете ващата поща за линк";
                        exit();
                    }
                } else {
                    header("Location: ../login.php?error=wrongpass");
                    $_SESSION['error'] = "Грешно потребителско име или парола";
                    exit();
                }
            } else {
                header("Location: ../login.php?error=nouser");
                $_SESSION['error'] = "Грешно потребителско име или парола";
                exit();
            }
        }
    }   

}else {
    header("Location: ../login.php?error=accessforbidden");
    $_SESSION['error'] = "Достъпът е забранен";
    exit();
}

?>