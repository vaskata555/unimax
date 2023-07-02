<?php
session_start();
require 'templates/dbConfig.php'; 
require './vendor/autoload.php';
header('Content-Type', 'application/json');
$stripe = new Stripe\StripeClient("sk_test_51MkU5NGKg9SGeuD8cKK85VWgZyvZHfezlF6h1R4ry79uqyluOuIZiAAhGExTp9VCghSjShW0gqnYLHcu6t2pyrqs00bcZs4j7t");

$line_items = array(); // Define an empty array for line items

foreach ($_SESSION["shopping_cart"] as $product){
    $item = [
        "price_data" =>[
           "currency" =>"BGN",
           "product_data" =>[
               "name"=> $product["title"],
               "description" => $product["desc"]
           ],
           "unit_amount" => $product["price"] * 100 // Multiply by 100 to convert to cents
        ],
        "quantity" => $product["quantity"] 
    ];
    array_push($line_items, $item); // Add the line item to the array
}

$session = $stripe->checkout->sessions->create([
    "success_url" => "http://localhost/unimax/success.php",
    "cancel_url" => "http://localhost/unimax/cancel.php",
    "payment_method_types" => ['card'],
    "mode" => 'payment',
    "line_items" => $line_items // Pass the array of line items to the checkout session
]);
echo json_encode($session);
if(isset($_SESSION['payarray'])) {
    $payarray = $_SESSION['payarray'];
  } else {
    $payarray = array();
  }

  foreach ($_SESSION["shopping_cart"] as $product){
    $code = $product["code"];
    $price = $product["price"];
    $title = $product["title"]; 
    $desc = $product["desc"];
    $id_product = $product["id"];
    $quantity = $product["quantity"];
    
    $found = false;
    foreach($payarray as &$item) {
        if($item['id'] == $id_product) {
            $found = true;
            
            break;
        }
    }
    
    if(!$found) {
        $new_record = array(
            'id' => $id_product,
            'title' => $title,
            'desc' => $desc,
            'code' => $code,
            'price' => $price,
            'quantity' => $quantity
        );
        $payarray[] = $new_record;
    }
}

$_SESSION['payarray'] = $payarray;

?>