<!DOCTYPE html>
<html>
    <head>
        <title>ORDER SUCCESSFULL</title>
        </head>
    <body>
<?php include('templates/header.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once 'vendor/autoload.php';

    ?> 

    <?php
 $type = $_SESSION['sessionUsertype'];
 if (!isset($_SESSION['sessionId']) || ($type != "user"&&$type !="admin"&&$type !="manager")) {
        header("Location: ../unimax/login.php?error=PleaseLoginToAccessThisPage");
        exit();
    }
   
    if (isset($_SESSION['payarray'])){
    $currentDateTime = date('YmdHis');
 $randomNumber = mt_rand(1, 9999);
 $order_number = $currentDateTime . '-' . $randomNumber;
 $order_date = date("Y-m-d");
  
?>
<div class="wrappersuccess">

<div class="containersuccess">
    <div class="printer-top"></div>
      
    <div class="paper-container">
      <div class="printer-bottom"></div>
  
      <div class="paper">
        <div class="main-contents">
          <div class="success-icon">&#10004;</div>
          <div class="success-title">
            Плащането завърши Успешно
          </div>
          <div class="success-description">
          
            Благодарим ви за направената поръчка!
            Очаквайте имейл с информация за поръчката
          </div>
          <div class="order-details">
          <div class="order-number-label">Номер на поръчка</div>
          <?php 
       
      
       
       ?>
            
            <div class="order-number"><?php echo $order_number?></div>
           
          </div>
          <div class="order-footer">Благодарим!</div>
        </div>
        <div class="jagged-edge"></div>
      </div>
    </div>
  </div>
  </div>
  <?php 
    

 $shopid = $_SESSION['sessionId'];

 $sql = "SELECT * FROM users WHERE id = ?";
 $stmt = mysqli_prepare($db, $sql);
 mysqli_stmt_bind_param($stmt, "i", $shopid);
 mysqli_stmt_execute($stmt);
 $result = mysqli_stmt_get_result($stmt);
 $user = mysqli_fetch_assoc($result);
 mysqli_stmt_close($stmt);
 
 include('pdfmaker.php');

 // Generate the warranty date
 $warranty_date = date("Y-m-d", strtotime("+1 year"));
 $email = $user["email"];
 $phone_number = $user["phone_number"];
 $username = $user["username"];
 $organization = $user["organization"];
 $first_name = $user["first_name"];
 $last_name = $user["last_name"];
 $address1 = $user["address1"];
 $address2 = $user["address2"];
 $post_code = $user["post_code"];
 $total_price = 0;
 $payment_type="card";
 foreach($_SESSION["payarray"] as $product){ 
  $total_price += ($product["price"]*$product["quantity"]);
 }
 $sql1 = "INSERT INTO orders (order_number, payment_type, invoice, order_date, warranty_date, user_id, email, phone_number, username, organization, bulstat, first_name, last_name, total_price, address1, address2, post_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
 $stmt1 = mysqli_prepare($db, $sql1);
 mysqli_stmt_bind_param($stmt1, "sssssssssssssssss", $order_number, $payment_type, $pdfFilePath, $order_date, $warranty_date, $shopid, $email, $phone_number, $username, $organization, $bulstat, $first_name, $last_name, $total_price, $address1, $address2, $post_code);
 mysqli_stmt_execute($stmt1);
 mysqli_stmt_close($stmt1);
 $sql = "INSERT INTO order_details (order_number, id_product, title, code, quantity, price) VALUES (?, ?, ?, ?, ?, ?)";
 $stmt = mysqli_prepare($db, $sql);
 print_r($_SESSION["payarray"]);
 foreach($_SESSION["payarray"] as $product){  

  $id_product = $product["id"];
  $code = $product["code"];
  $quantity = $product["quantity"];
  $price = $product["price"];
  $title = $product["title"];
  $total_price += ($product["price"]*$product["quantity"]);



mysqli_stmt_bind_param($stmt, "ssssss", $order_number, $id_product ,  $title, $code, $quantity, $price);
     mysqli_stmt_execute($stmt);
     mysqli_error($db);
 }

 mysqli_stmt_close($stmt);
 
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

  foreach ($_SESSION['payarray'] as $product) {
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
      Фактурата с информация за поръчката е прикачена към имейла <br>
      номер поръчка: ' . "$order_number" . '<br>
      Благодарим ви!<br><br>
      екип на Унимакс ООД<br>
      телефон:0876377999 <br>
      email:team@unimaxeood.com ';

  $phpmailer->Body = $emailBody;
  $phpmailer->isHTML(true);

  // Send the email
  $phpmailer->send();


} catch (Exception $e) {
  echo 'Verification email could not be sent. Error: ', $phpmailer->ErrorInfo;
}

// Output the PDF as a file (you can also use 'inline' to output directly to the browser)

 unset($_SESSION['payarray']);
 unset($_SESSION['shopping_cart']);
}else if(isset($_SESSION['ordernumber'])){
  $order_number1 = $_SESSION['ordernumber'];
  ?>
  <div class="wrappersuccess">

  <div class="containersuccess">
      <div class="printer-top"></div>
        
      <div class="paper-container">
        <div class="printer-bottom"></div>
    
        <div class="paper">
          <div class="main-contents">
            <div class="success-icon">&#10004;</div>
            <div class="success-title">
              Поръчката е успешна
            </div>
            <div class="success-description">
            
              Благодарим ви за направената поръчка!
              Очаквайте имейл с информация за покупките
             
            </div>
            <div class="order-details">
            <div class="order-number-label">Номер на поръчка</div>
            <?php 
         
        
         
         ?>
              
              <div class="order-number"><?php echo $order_number1?></div>
             
            </div>
            <div class="order-footer">Благодарим!</div>
          </div>
          <div class="jagged-edge"></div>
        </div>
      </div>
    </div>
    </div>
<?php
 unset($_SESSION['ordernumber']);
 unset($_SESSION['payarray']);
 unset($_SESSION['shopping_cart']);
}else{
  
 echo"<div class='wrappersuccess'>

 <div class='containersuccess'>
     <div class='printer-top'></div>
       
     <div class='paper-container'>
       <div class='printer-bottom'></div>
   
       <div class='paper'>
         <div class='main-contents'>
           <div class='success-icon'>?</div>
           <div class='success-title'> 
 <h1>Нищо за показване тук</h1>
 
 </div>
 </div>
 </div>";
  
}?>
</div>
 </div>
</body>
  </html>
  <?php include('templates/footer.php'); ?>