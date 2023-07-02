<?php
require_once 'templates/header.php';
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']); // Remove the error from the session after retrieving it
  } else {
    $error = ""; // Set a default value if no error is present
  }
?>

<div>
<div class="content">
<script src='background.js'defer></script>

<div class="enterform">
    <div class="centerform">
      
        <div class="insideformlogin">
   
  <form class="loginformcenter" action="templates/login-inc.php" method="post">
        
   

<div class="registration">


  <div class="insidelogin">
    <h1> Влизане в профил</h1>
    <p>нямате профил? натиснете <a href="register.php">Тук<a></p>
  <form>
  <br>
  <p><?php echo $error; ?></p>
  <br>
  
       <input type="text" name="username" placeholder="Username">
       <br>
        <input type="password" name="password" placeholder="Password">
        <div >
      <span><button class="register_button" type="submit" name="submit">Вход</button></span>
    </div>
  </form>
</div>
    </form>
</div>
</div>
</div>
</div>
</div>
<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
<?php
require_once 'templates/footer.php';
?>

