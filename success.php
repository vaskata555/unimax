<!DOCTYPE html>
<html>
    <head>
        <title>ORDER SUCCESSFULL</title>
        </head>
    <body>
<?php include('templates/header.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once 'vendor/dompdf-master/autoload.inc.php'; // Include the Dompdf autoload file

use Dompdf\Dompdf;
require 'vendor/autoload.php';
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

 $sql = "SELECT * FROM users1 WHERE id = ?";
 $stmt = mysqli_prepare($db, $sql);
 mysqli_stmt_bind_param($stmt, "i", $shopid);
 mysqli_stmt_execute($stmt);
 $result = mysqli_stmt_get_result($stmt);
 $user = mysqli_fetch_assoc($result);
 mysqli_stmt_close($stmt);
 
 

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
 $sql = "INSERT INTO payment_info (order_number,payment_type,order_date,warranty_date,user_id, email, phone_number, username,organization,first_name,last_name,id_product,code,quantity,price,title,total_price,address1,address2,post_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
 foreach($_SESSION["payarray"] as $product){  

  $id_product = $product["id"];
  $code = $product["code"];
  $quantity = $product["quantity"];
  $price = $product["price"];
  $title = $product["title"];
  $total_price += ($product["price"]*$product["quantity"]);


$stmt = mysqli_prepare($db, $sql);
     mysqli_stmt_bind_param($stmt, "ssssssssssssssssssss", $order_number,$payment_type,$order_date,$warranty_date,$shopid, $email, $phone_number, $username, $organization, $first_name, $last_name,$id_product, $product["code"],$product["quantity"], $product["price"], $product["title"], $total_price, $address1, $address2, $post_code);
     mysqli_stmt_execute($stmt);
    
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
  $phpmailer->Subject = 'Email/Registration Verification Unimax.com';

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
$dompdf = new Dompdf();

// Load HTML content for the invoice
$html = '
<!DOCTYPE html>
<html>
<head>
    <style>
        /* Define CSS styles for the invoice */
        body {
            font-family: Arial, sans-serif;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-title {
            font-size: 24px;
            font-weight: bold;
        }

        .invoice-details {
            margin-bottom: 10px;
        }

        .invoice-details span {
            font-weight: bold;
        }

        .customer-details span {
            font-weight: bold;
        }

        .payment-details span {
            font-weight: bold;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .receiver-box, .provider-box {
            display: inline-block;
            width: 45%;
            padding: 10px;
            border: 1px solid #ddd;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="invoice-header">
        <h1 class="invoice-title">Payment Invoice</h1>
    </div>
    <div class="invoice-details">
        <span>Invoice Number:</span> INV-001<br>
        <span>Date:</span> 2023-06-09
    </div>
    <div class="customer-details">
        <span>Customer:</span> John Doe
    </div>
    <div class="payment-details">
        <span>Amount:</span> $100.00<br>
        <span>Payment Method:</span> Credit Card
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Product 1</td>
                <td>2</td>
                <td>$25.00</td>
                <td>$50.00</td>
            </tr>
            <tr>
                <td>Product 2</td>
                <td>1</td>
                <td>$30.00</td>
                <td>$30.00</td>
            </tr>
            <tr>
                <td>Product 3</td>
                <td>3</td>
                <td>$15.00</td>
                <td>$45.00</td>
            </tr>
        </tbody>
    </table>
    <div class="receiver-box">
        <h3>Receiver</h3>
        <p>John Doe</p>
        <p>123 Main Street</p>
        <p>City, State, ZIP</p>
    </div>
    <div class="provider-box">
        <h3>Provider</h3>
        <p>Your Company</p>
        <p>456 Business Avenue</p>
        <p>City, State, ZIP</p>
    </div>
</body>
</html>';
$dompdf->loadHtml($html);

// Set paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the PDF as a file (you can also use 'inline' to output directly to the browser)
$dompdf->stream('payment_invoice.pdf', ['Attachment' => true]);
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
              Плащането завърши Успешно
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