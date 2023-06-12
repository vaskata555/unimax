<?php
session_start();
$post_code = $_POST['post_code'];
$total_price = $_POST['total_price'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once 'vendor/autoload.php';
if (isset($_POST['submit1'])) {
    require 'templates/dbConfig.php'; 
   
     
   
   
    echo"$total_price"."test";
    foreach($_SESSION["shopping_cart"] as $key => $value){
        if($value['code'] === $_POST["code"]){
            $product = $_SESSION["shopping_cart"][$key];
            break; // Stop the loop after we've found the product
        }
    }
    
    if ($total_price == 0) {
        // header("Location: ../index.php?error=norpice");
        exit();
    } else if (!preg_match('/^[0-9]{5}$/', $post_code) && ($post_code < 1000 && $post_code > 9999)) {
        // replace 'postal_code' with the name of the input field in your HTML form
       // header("Location: ../index.php?error=postcodeInvalid");
        exit();
    } else {
        $dataOk=true;
            $code = $product["code"];
        $price = $product["price"];
        $title = $product["title"]; 
        $id_product=$product["id"];
        $quantity = $product["quantity"]; 
        echo "$post_code";
        $shopid = $_SESSION['sessionId'];
        echo "$shopid";
        $sql = "SELECT * FROM users1 WHERE id = ?";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "i", $shopid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        
        $currentDateTime = date('YmdHis');
        $randomNumber = mt_rand(1, 9999);
        $order_number = $currentDateTime . '-' . $randomNumber;
        $order_date = date("Y-m-d");
        $_SESSION['ordernumber'] =  $order_number;
        // Generate the warranty date
        $warranty_date = date("Y-m-d", strtotime("+1 year"));
        $email = $user["email"];
        $phone_number = $user["phone_number"];
        $username = $user["username"];
        $organization = $user["organization"];
        $bulstat = $user["bulstat"];
        $first_name = $user["first_name"];
        $last_name = $user["last_name"];
        $payment_type="cash";
        include('pdfmaker.php');
        $sql = "INSERT INTO payment_info (order_number,payment_type,invoice,order_date,warranty_date,user_id, email, phone_number, username,organization,bulstat,first_name,last_name,id_product,code,quantity,price,title,total_price,address1,address2,post_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($db, $sql);
        foreach ($_SESSION["shopping_cart"] as $key => $value) {
            
            mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssss", $order_number,$payment_type,$pdfFilePath,$order_date,$warranty_date,$shopid, $email, $phone_number, $username, $organization,$bulstat, $first_name, $last_name,$id_product, $value["code"],$value["quantity"], $value["price"], $value["title"], $total_price, $address1, $address2, $post_code);
            mysqli_stmt_execute($stmt);
            
        }
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
       
         $phpmailer->setFrom('sender@example.com', 'Sender Name');
         $phpmailer->addAddress($email, $username); // Use the registered user's email and username
         $phpmailer->Subject = 'Извършена поръчка Unimax.com';
         $attachmentPath = 'invoices/payment_invoice_' . $order_number . '.pdf';

         // Add the attachment
         $phpmailer->addAttachment($attachmentPath);
         // Create the email body
         $emailBody = 'Здравейте' . " " . $first_name . " " . $last_name . "," . ' <br>Благодарим ви за направената поръчка!<br>
             <table style="border: 1px solid;">
             <tr style="border: 1px solid; text-align: center;">
             <th style="border: 1px solid; padding: 5px;">име на продукт</th>
             <th style="border: 1px solid; padding: 5px;">количество</th>
             <th style="border: 1px solid; padding: 5px;">единична цена</th>
         </tr>';
       
         foreach ($_SESSION["shopping_cart"] as $product) {
             $quantity = $product["quantity"];
             $price = $product["price"];
             $title = $product["title"];
       
             $emailBody .= '<tr style="border: 1px solid; text-align: center;">
             <td style="border: 1px solid; padding: 5px;">' . "$title" . '</td>
             <td style="border: 1px solid; padding: 5px;">' . "$quantity" . '</td>
             <td style="border: 1px solid; padding: 5px;">' . "$price" . '</td>
         </tr>';
       }
       
         $emailBody .= '
             </table>
             номер поръчка: ' . "$order_number" . '
             Благодарим ви!<br><br>
             екип на Унимакс ООД<br>
             телефон: <br>
             email: ';
       
         $phpmailer->Body = $emailBody;
         $phpmailer->isHTML(true);
       
         // Send the email
         $phpmailer->send();
       
         echo 'Verification email sent successfully!';
       } catch (Exception $e) {
         echo 'Verification email could not be sent. Error: ', $phpmailer->ErrorInfo;
       }
      
       
        mysqli_stmt_close($stmt);
        unset($_SESSION['shopping_cart']);
        if ($dataOk) {
            // Redirect to another page
            header("Location: success.php");
            exit(); // It's important to
        }
    }
}


?>