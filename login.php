<?php
require_once 'templates/header.php';
?>

<div>
<div class="content">
<script src='background.js'defer></script>
<div class="enterform">
    <div class="centerform">
        <div class="insideformlogin">
    <p> LOGIN HERE! </p>
    
    
    <form action="templates/login-inc.php" method="post">
        
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <div >
      <span><button class="register_button" type="submit" name="submit">Login</button></span>
    </div>
    </form>

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

