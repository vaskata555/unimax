<?php
require_once 'templates/header.php';
?>

<div>
<div class="content">
<script src='background.js'defer></script>
<div class="enterform">
    <div class="centerform">
        <div class="insideform">
    <form action="templates/register-inc.php" method="post">
        
   <!-- <span class="input">    
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="confirmPassword" placeholder="Confirm password">
        <button type="submit" name="submit">REGISTRER</button>
        <span></span>	
	</span>
-->
<div class="registration">
  <form>
    <label>Your email</label>
    <input type="text" />
    <p class="error">
      <span>This email exists already in the database</span>
    </p>

    <label>Password</label>
    <input type="text" />
    <p class="error">
      <span>At least 8 characters</span>
    </p>

    <label>Password [repeat]</label>
    <input type="text" />
    <p class="error">
      <span>Some text here</span>
    </p>

    <div class="register_button">
      <span><a href="#">REGISTER</a></span>
    </div>
  </form>
</div>
    </form>
</div>
</div>
</div>
    <div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
</div>
</div>

<?php
require_once 'templates/footer.php';
?>

