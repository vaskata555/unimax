<?php
use Dompdf\Dompdf;

$dompdf = new Dompdf();
$imagePath = 'unimax.png'; // Replace with the actual path to your image file

// Read image file
$imageData = file_get_contents($imagePath);
$shopid = $_SESSION['sessionId'];

 $sql = "SELECT * FROM users1 WHERE id = ?";
 $stmt = mysqli_prepare($db, $sql);
 mysqli_stmt_bind_param($stmt, "i", $shopid);
 mysqli_stmt_execute($stmt);
 $result = mysqli_stmt_get_result($stmt);
 $user = mysqli_fetch_assoc($result);
 mysqli_stmt_close($stmt);
 $organization = $user["organization"];
 $bulstat = $user["bulstat"];
 $first_name = $user["first_name"];
 $last_name = $user["last_name"];
 $address1 = $user["address1"];
 $address2 = $user["address2"];
 $post_code = $user["post_code"];
 $currentDateTime = date('Ymd');
// Convert image data to base64
$base64Image = base64_encode($imageData);
// Load HTML content for the invoice
if (isset($_SESSION['payarray'])){
$html = '
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style>
      * {
        font-family: "DejaVu Sans" !important;
      }
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

        .table th,
        .table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .receiver-box,
        .provider-box {
            display: block;
            padding: 10px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
        }

        .box-container {
            display: flex;
            justify-content: space-between;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 200px;
        }
    </style>
</head>
<body>
    <div class="logo">
    <img src="data:image/jpeg;base64,' . $base64Image . '" alt="Logo">
    </div>
    <div class="invoice-header">
        <h1 class="invoice-title">ФАКТУРА</h1>
    </div>
    <div class="invoice-details">
        <span>Номер: </span>' . $order_number. '
  
        <span>Дата:</span>' . $currentDateTime. '
  
    <div class="payment-details">
    </div>
    <div class="box-container">
        <div class="receiver-box">
            <h3>Получател</h3>
            <p> Име: ' . $first_name . " ". $last_name .'</p>
            <p>адрес на доставка: ' . $address1 . '</p>
            <p>адрес на плащане: ' . $address2 . '</p>
            <p>фирма: ' . $organization . '</p>
            <p>БУЛСТАТ: ' . $bulstat . '</p>
            <p>пощенски код: ' . $post_code . '</p>
        </div>
        <div class="provider-box">
            <h3>Издател</h3>
            <h3>Мол:456612378</h3>
            <p>Унимакс оод</p>
            <p>Бургас улица поморие 12</p>
            <p>8000</p>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Продукт</th>
                <th>Количество</th>
                <th>Цена</th>
                <th>Общо</th>
            </tr>
        </thead>
        <tbody>';
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
// Iterate through each product in the payarray
$totalPrice = 0;

foreach ($_SESSION["payarray"] as $product) {
    $html .= '
            <tr>
                <td>' . $product["title"] . '</td>
                <td>' . $product["quantity"] . '</td>
                <td>BGN' . $product["price"] . '</td>
                <td>BGN' . ($product["quantity"] * $product["price"]) . '</td>
            </tr>';

    $totalPrice += $product["quantity"] * $product["price"];
}

$html .= '
            <tr>
                <td colspan="3" style="text-align: right;">Total:</td>
                <td>BGN' . $totalPrice . '</td>
            </tr>
        </tbody>
    </table>
</body>
</html>';

$dompdf->loadHtml($html);

// Set paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Get the generated PDF content
$pdfContent = $dompdf->output();

// Generate a unique file name for the invoice
$fileName = 'payment_invoice_' . $order_number . '.pdf';

// Specify the directory path to save the invoice file
$directoryPath = 'invoices/';

// Ensure that the directory exists, if not, create it
if (!is_dir($directoryPath)) {
    mkdir($directoryPath, 0777, true);
}

// Set the full file path
$pdfFilePath = $directoryPath . $fileName;

// Save the PDF to the specific directory
file_put_contents($pdfFilePath, $pdfContent);
}else if((isset($_SESSION['ordernumber']))){
    $html = '
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style>
      * {
        font-family: "DejaVu Sans" !important;
      }
        /* Define CSS styles for the invoice */
        body {
            font-family: Arial, sans-serif;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 7px;
        }

        .invoice-title {
            font-size: 24px;
            font-weight: bold;
        }

        .invoice-details {
            margin-bottom: 5px;
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

        .table th,
        .table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .receiver-box,
        .provider-box {
            display: block;
            padding: 6px;
            border: 1px solid #ddd;
            margin-bottom: 6px;
        }

        .box-container {
            display: flex;
            justify-content: space-between;
        }

        .logo {
            text-align: center;
            margin-bottom: 15px;
        }

        .logo img {
            max-width: 200px;
        }
    </style>
</head>
<body>
    <div class="logo">
    <img src="data:image/jpeg;base64,' . $base64Image . '" alt="Logo">
    </div>
    <div class="invoice-header">
        <h1 class="invoice-title">ФАКТУРА</h1>
    </div>
    <div class="invoice-details">
        <span>Номер: </span>' . $order_number. '
  
        <span>Дата:</span>' . $currentDateTime. '
  
    <div class="payment-details">
    </div>
    <div class="box-container">
        <div class="receiver-box">
            <h3>Получател</h3>
            <p> Име: ' . $first_name . " ". $last_name .'</p>
            <p>адрес на доставка: ' . $address1 . '</p>
            <p>адрес на плащане: ' . $address2 . '</p>
            <p>фирма: ' . $organization . '</p>
            <p>БУЛСТАТ: ' . $bulstat . '</p>
            <p>пощенски код: ' . $post_code . '</p>
        </div>
        <div class="provider-box">
            <h3>Издател</h3>
            <h3>Мол:456612378</h3>
            <p>Унимакс оод</p>
            <p>Бургас улица поморие 12</p>
            <p>8000</p>
        </div>
       
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Продукт</th>
                <th>Количество</th>
                <th>Цена</th>
                <th>Общо</th>
            </tr>
        </thead>
        
        <tbody>';
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
// Iterate through each product in the payarray
$totalPrice = 0;
$ddsprice=0;
foreach ($_SESSION["shopping_cart"] as $product) {
    $html .= '
            <tr>
                <td>' . $product["title"] . '</td>
                <td>' . $product["quantity"] . '</td>
                <td>BGN' . $product["price"] . '</td>
                <td>BGN' . ($product["quantity"] * $product["price"]) . '</td>
            </tr>';

    $totalPrice += $product["quantity"] * $product["price"];
    $ddsprice += $totalPrice*0.2;
    $bezdds = $totalPrice - $ddsprice;
    $totalPrice = number_format($totalPrice, 2);
$ddsprice = number_format($ddsprice, 2);
$bezdds = number_format($bezdds, 2);
}

$html .= '
            <tr>
                <td colspan="3" style="text-align: right;">Total:</td>
                <td>Total: BGN' . $totalPrice . '</td>
                <td>DDS: BGN' .  $ddsprice . '</td>
                <td>Total без DDS: BGN' .   $bezdds . '</td>
            </tr>
        </tbody>
    </table>
    <div class="provider-box">
    <p>Съгласно чл.7,ал.1 от Закона за счетоводството. Чл.114 от ЗДДС и
    чл. 78 от ИИЗДДС печатът и подписът не са задължителен реквизит</p>
    <p>В случай,че Булстат не бъде предоставен(което е задължително условие за легитимност на документа) или получателят е физиеско лице,
    то следва,че бележката е информативна,но не и официален документ.</p>
    <p>Унимакс не носи отговорност за документи с невярно съдържание</p>
    </div>
</body>
</html>';

$dompdf->loadHtml($html);

// Set paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Get the generated PDF content
$pdfContent = $dompdf->output();

// Generate a unique file name for the invoice
$fileName = 'payment_invoice_' . $order_number . '.pdf';

// Specify the directory path to save the invoice file
$directoryPath = 'invoices/';

// Ensure that the directory exists, if not, create it
if (!is_dir($directoryPath)) {
    mkdir($directoryPath, 0777, true);
}

// Set the full file path
$pdfFilePath = $directoryPath . $fileName;

// Save the PDF to the specific directory
file_put_contents($pdfFilePath, $pdfContent);
}
?>