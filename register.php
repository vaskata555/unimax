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
    <input type="email" pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" name="email"placeholder="Email" required >
    <p class="error">
      
    </p>
    <label>Your Username</label>
    <input type="text" name="username" placeholder="Username" required><br>
    <p class="error">
     
    </p>
    <label for="first_name">First Name:</label><br>
    
			<input type="text" id="first_name" name="first_name"placeholder="Иван" required><br>
     
      <label for="lastName">Last Name:</label><br>
			<input type="text" id="last_name" name="last_name" placeholder="Иванов" required><br>

      <label for="organization">Organization:</label><br>
			<input type="text" id="organization" name="organization" required><br>

      <label for="phone_number">Phone Number:</label><br>
			<input type="text" id="phone_number" name="phone_number" required><br>

    <label>Password</label>
    <input type="password" name="password" placeholder="Password">
    <p class="error">
      <span>At least 8 characters</span>
    </p>

    <label>Password [repeat]</label>
    <input type="password" name="confirmPassword" placeholder="Confirm password">
    
   
    <div >
      <span><button type="submit" class="register_button" name="submit">REGISTRER</button></span>

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

