<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'verification.php';
require __DIR__ .'/../vendor/autoload.php';
if (isset($_POST['submit'])) {
    //Add database connection
    require 'dbConfig.php';
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPass = $_POST['confirmPassword'];
    $organization = $_POST['organization'];
    $bulstat = $_POST['bulstat'];
    $radioButtonSelected = $_POST['companyperson'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];

    $verificationToken = generateVerificationToken();

    if (empty($username) || empty($password) || empty($confirmPass) || empty($email)||empty($first_name)||empty($last_name)||empty($phone_number)) {
        header("Location: ../register.php?error=emptyfields&username=".$username);
        $_SESSION['error'] = "Моля, попълнете всички задължителни полета.";
        exit();
    } elseif (!preg_match("/^[\p{L}\p{N}]+$/u", $username)) {
        header("Location: ../register.php?error=invalidusername&username=".$username);
        $_SESSION['error'] = "Невалидно потребителско име. Моля, използвайте само букви и цифри.";
        exit();
    } elseif (!preg_match("/^[\p{L}]+$/u", $first_name)) {
        header("Location: ../register.php?error=invalidname=".$first_name);
        $_SESSION['error'] = "Невалидно име. Моля, използвайте само букви.";
        exit();
    } elseif (!preg_match("/^[\p{L}]+$/u", $last_name)) {
        header("Location: ../register.php?error=invalidlastname=". $last_name);
        $_SESSION['error'] = "Невалидна фамилия. Моля, използвайте само букви.";
        exit();
    } elseif($password !== $confirmPass) {
        header("Location: ../register.php?error=passwordsdonotmatch=");
        $_SESSION['error'] = "Паролите не съвпадат. Моля, въведете същата парола в двете полета.";
        exit();
    }elseif (strlen($email) > 32 || strlen($email) <= 4) {
        header("Location: ../register.php?error=invalidemailtooshortortoolong=");
        $_SESSION['error'] = "Невалидна дължина на имейла. Моля, въведете имейл между 5 и 32 символа.";
        exit();
    }elseif (strlen($username) > 16 || strlen($username) <= 4) {
        header("Location: ../register.php?error=invalidusernametooshortortoolong&username=".$username);
        $_SESSION['error'] = "Невалидна дължина на потребителското име. Моля, въведете потребителско име между 5 и 16 символа.";
        exit();
    } elseif (!verifyBulstat($bulstat)) {
        header("Location: ../register.php?error=invalidbulstat&bulstat=".$bulstat);
        $_SESSION['error'] = "Невалиден булстат. Моля, въведете валиден булстат.";
        exit();
    }
    elseif (strlen( $first_name) > 25 || strlen( $first_name) <= 1) {
        header("Location: ../register.php?error=invalidnametooshort=".$username);
        $_SESSION['error'] = "Невалидна дължина на името. Моля, въведете име между 2 и 25 символа.";
        exit();
    } elseif (strlen($password) > 35 || strlen($password) <= 8) {
        header("Location: ../register.php?error=invalidpasswordtooshort&password");
        $_SESSION['error'] = "Невалидна дължина на паролата. Моля, въведете парола между 8 и 35 символа.";
        exit();
    }elseif  (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         
            header("Location: ../register.php?error=invalidemail&email=".$email);
            $_SESSION['error'] = "Невалиден имейл адрес. Моля, въведете валиден имейл адрес.";
            exit();
          
        
        
        } else {
            $sql = "SELECT username, email FROM users WHERE username = ? OR email = ?";
            $stmt = mysqli_stmt_init($db);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../register.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "ss", $username, $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $rowCount = mysqli_stmt_num_rows($stmt);
        
                if ($rowCount > 0) {
                    mysqli_stmt_bind_result($stmt, $existingUsername, $existingEmail);
                    while (mysqli_stmt_fetch($stmt)) {
                        if ($existingUsername === $username) {
                            header("Location: ../register.php?error=usernametaken");
                            $_SESSION['error'] = "Потребителското име е заето. Моля изберете друго";
                            exit();
                        }
                        if ($existingEmail === $email) {
                            header("Location: ../register.php?error=emailtaken");
                            $_SESSION['error'] = "Имейлът е зает. Моля използвайте друг или възстановете акаунта си";
                            exit();
                        }
                    }
                } else {
                $type = "user";
                
                $sql = "INSERT INTO users (verification_token,email, username, password,type,organization,bulstat,first_name,last_name,phone_number) VALUES (? ,? ,? ,? ,? ,? ,? ,? ,?, ?)";
                $stmt = mysqli_stmt_init($db);
              
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../register.php?error=sqlerror");
                    exit();
                } else {
                    $hashedPass = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "ssssssssss",$verificationToken,$email, $username, $hashedPass,$type,$organization,$bulstat,$first_name,$last_name,$phone_number);
                    mysqli_stmt_execute($stmt);
                    $phpmailer = new PHPMailer(true);
                    $phpmailer->CharSet = 'UTF-8';
                    $_SESSION['error'] = "Успешно се регистрирахте моля потвърдете имейл адреса си чрез връзката в изпратеният имейл";

try {
    // Configure PHPMailer for SMTP
    $phpmailer->isSMTP();
    $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 2525;
    $phpmailer->Username = '31792ac26691f8';
    $phpmailer->Password = '21ed3c0733371a';

    // Set email details
    $phpmailer->setFrom('sender@example.com', 'Sender Name');
    $phpmailer->addAddress($email, $username); // Use the registered user's email and username
    $phpmailer->Subject = 'Имейл верификация Unimax Eood ';
    $phpmailer->Body = 'Здравейте'." " . $first_name ." " .$last_name ."," . ' <br>Благодарим ви за направената регистрация!<br> Потвърдете вашият акаунт, за да потвърдим вашият имейл адрес. Цъкнете тук: <a href="localhost/unimax/verify.php?token=' . $verificationToken . '">Потвърди имейл</a><br>Ако имате някакви въпроси или срещнете проблеми по време на процеса на регистрация,<br> моля не се колебайте да се свържете с нашия екип за поддръжка на имейл supportunimax@unimaxood.com.<br>

    Очакваме ви.<br> <br>
    
    екип на Унимакс ООД<br>
    телефон:0876377999 <br>
    email: team@unimaxeood.com
    ';
    $phpmailer->isHTML(true);

    // Send the email
    $phpmailer->send();

    echo 'Verification email sent successfully!';
} catch (Exception $e) {
    echo 'Verification email could not be sent. Error: ', $phpmailer->ErrorInfo;
}
                        header("Location: ../register.php?success=registered".mysqli_error($db));
                        exit();
                }
            }
        }
    }
   
}
function verifyBulstat($bulstat) {
   
        // Remove any non-digit characters
        $bulstat = preg_replace('/[^0-9]/', '', $bulstat);
        if (empty($bulstat)) {
            return true; // Allow empty input, return true or handle accordingly
        }
        // Validate the length
        if (strlen($bulstat) !== 9) {
            return false;
        }
        
        // Validate the control digit
        $controlDigit = intval(substr($bulstat, -1));
        $multipliers = [21, 19, 17, 13, 11, 9, 7, 3, 1];
        $sum = 0;
        
        for ($i = 0; $i < 9; $i++) {
            $digit = intval($bulstat[$i]);
            $sum += $digit * $multipliers[$i];
        }
        
        $remainder = $sum % 10;
        $validControlDigit = ($remainder === 0 || ($remainder === 9 && $controlDigit === 9));
        
        return $validControlDigit;
    
}
