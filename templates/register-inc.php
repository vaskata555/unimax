<?php
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
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $verificationToken = generateVerificationToken();

    if (empty($username) || empty($password) || empty($confirmPass) || empty($email)||empty($first_name)||empty($last_name)||empty($phone_number)) {
        header("Location: ../register.php?error=emptyfields&username=".$username);
        exit();
    } elseif (!preg_match("/^[a-zA-Z0-9]*/", $username)) {
        header("Location: ../register.php?error=invalidusername&username=".$username);
        exit();
    } elseif (!preg_match("/^[a-zA-Z0-9]*/", $first_name)) {
        header("Location: ../register.php?error=invalidname=".$first_name);
        exit();
    } elseif (!preg_match("/^[a-zA-Z0-9]*/",  $last_name)) {
        header("Location: ../register.php?error=invalidlastname=". $last_name);
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
    } elseif (!verifyBulstat($bulstat)) {
        header("Location: ../register.php?error=invalidbulstat&bulstat=".$bulstat);
        exit();
    }
    elseif (strlen( $first_name) > 25 || strlen( $first_name) <= 1) {
        header("Location: ../register.php?error=invalidnametooshort=".$username);
        exit();
    } elseif (strlen($password) > 20 || strlen($password) <= 8) {
        header("Location: ../register.php?error=invalidpasswordtooshort&password=");
        exit();
    }elseif  (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         
            header("Location: ../register.php?error=invalidemail&email=".$email);
            exit();
          
        
        
        } else {
            $sql = "SELECT username, email FROM users1 WHERE username = ? OR email = ?";
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
                            exit();
                        }
                        if ($existingEmail === $email) {
                            header("Location: ../register.php?error=emailtaken");
                            exit();
                        }
                    }
                } else {
                $type = "user";
                
                $sql = "INSERT INTO users1 (verification_token,email, username, password,type,organization,bulstat,first_name,last_name,phone_number) VALUES (? ,? ,? ,? ,? ,? ,? ,? ,?, ?)";
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
    $phpmailer->Subject = 'Email/Registration Verification Unimax.com ';
    $phpmailer->Body = 'Здравейте'." " . $first_name ." " .$last_name ."," . ' <br>Благодарим ви за направената регистрация!<br> Потвърдете варшият акаунт
    За да гарантираме сигурността на вашия акаунт и за да потвърдим вашият имейл адрес. Цъкнете тук: <a href="localhost/unimax/verify.php?token=' . $verificationToken . '">Потвърди имейл</a><br>Ако имате някакви въпроси или срещнете проблеми по време на процеса на регистрация,<br> моля не се колебайте да се свържете с нашия приятелски екип за поддръжка на [Имейл/Контактна информация].<br>

    Очакваме ви.<br> <br>
    
    екип на Унимакс ООД<br>
    телефон: <br>
    email:
    ';
    $phpmailer->isHTML(true);

    // Send the email
    $phpmailer->send();

    echo 'Verification email sent successfully!';
} catch (Exception $e) {
    echo 'Verification email could not be sent. Error: ', $phpmailer->ErrorInfo;
}
                        header("Location: ../register.php?success=registered");
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



?>