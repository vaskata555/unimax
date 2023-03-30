<?php
session_start();
$post_code = $_POST['post_code'];
$total_price = $_POST['total_price'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];

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

        // Generate the warranty date
        $warranty_date = date("Y-m-d", strtotime("+1 year"));
        $email = $user["email"];
        $phone_number = $user["phone_number"];
        $username = $user["username"];
        $organization = $user["organization"];
        $first_name = $user["first_name"];
        $last_name = $user["last_name"];
        
       
        $sql = "INSERT INTO payment_info (order_number,order_date,warranty_date,user_id, email, phone_number, username,organization,first_name,last_name,id_product,code,quantity,price,title,total_price,address1,address2,post_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($db, $sql);
        foreach ($_SESSION["shopping_cart"] as $key => $value) {
            
            mysqli_stmt_bind_param($stmt, "sssssssssssssssssss", $order_number,$order_date,$warranty_date,$shopid, $email, $phone_number, $username, $organization, $first_name, $last_name,$id_product, $value["code"],$value["quantity"], $value["price"], $value["title"], $total_price, $address1, $address2, $post_code);
            mysqli_stmt_execute($stmt);
            
        }
        
      
       
        mysqli_stmt_close($stmt);
    }
}


?>