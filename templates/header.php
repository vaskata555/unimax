<?php require_once 'dbConfig.php'; 
//session_set_cookie_params(0);
session_start();

?>
<!DOCTYPE html>
<head>

<link rel="stylesheet" href="templates/style.css">
<script src="templates/jquery.min.js"></script>
<script src="templates/togglemenu.js"></script>
<script  src="templates/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0, 
user-scalable=no">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<title>UnimaxOOD</title>


</head>
<body>

<nav>
<div class="topnav" id="myTopnav">
<a href="index.php" class="logoa"><img src="unimax2.png" class="logo"alt="unimax" ></a>

  <a href="products.php">Продукти</a>
  <a href="q&a.php">За нас</a>
  
  <?php
if (isset($_SESSION['sessionId'])) {
 $type = $_SESSION['sessionUsertype'];
if($type=='admin'||$type=='user'||$type=='manager'){
   echo '<a href='.'shoppingcart.php'.'>'.'<i class="fa fa-shopping-cart"aria-hidden="true"></i>'.' Количка'.'</a>';
}
}
?>
   <?php
if (isset($_SESSION['sessionId'])) {
 $type = $_SESSION['sessionUsertype'];
if($type=='admin'||$type=='user'||$type=='manager'){
   echo '<a href='.'profile.php'.'>'.'Профил'.'</a>';
}
}
?>
 <?php
if (isset($_SESSION['sessionId'])) {
 $type = $_SESSION['sessionUsertype'];
if($type=='admin'||$type=='user'||$type=='manager'){
   echo '<a href='.'appointment.php'.'>'.'Запази
   час'.'</a>';
}
}
?>
<div id="dropdown-header" class="dropdown-header">
<a href="#"class="dropdown-link"><img src="user.png" width="50px" height="50px"></a>
<div class="dropdown-header-content">
   <ul>
 <a class="linklg"href="login.php"  >Вход</a> 
 <a class="linklg" href="register.php"  >Регистрация</a> 
</ul>
  </div>
</div>
<a id="hiddenbutton" href="login.php" >Вход в сайта</a>
<a id="hiddenbutton" href="register.php"  >Регистрация</a>
<a href="javascript:void(0);" class="icon" onclick="myFunction()">
  <i class="fa fa-bars"></i>
  </a>
  

</div>

</nav>
  
</header>

