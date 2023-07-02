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
<script src='registerhandler.js'defer></script>
<div class="enterform">
    <div class="centerform">
      
        <div class="insideformregister">
   
    <form class="registerformcenter" action="templates/register-inc.php" method="post">
        
<div class="registration">


  <div class="insideregister">
  <h1> Регистрация на профил</h1>
  <form>
  <br>
  <p><?php echo $error; ?></p>
  <br>
  
      <input type="radio" id="company" name="companyperson" value='1' checked>
      <label for="company">Юридическо лице</label>
    <br>
      <input type="radio" id="person" name="companyperson"  value='2'>
      <label for="person">физическо лице</label>
      <br>
    <label>Имейл:</label><br>
    <input type="email" pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" name="email"placeholder="Email" required >
    <p class="error">
      
    </p>
    <label>Потребителско име:</label><br>
    <input type="text" name="username" placeholder="Потребителско име" required><br>
    <p class="error">
     
    </p>
    <label for="first_name">Име:</label><br>
    
			<input type="text" id="first_name" name="first_name"placeholder="Иван" required><br>
     
      <label for="lastName">фамилия:</label><br>
			<input type="text" id="last_name" name="last_name" placeholder="Иванов" required><br>

      <label for="organization">Име на фирма</label><br>
			<input type="text" id="organization" name="organization" required><br>

      <label for="bulstat">Булстат</label><br>
			<input type="text" id="bulstat" name="bulstat"required ><br>
      
      <label for="phone_number">Телефонен номер</label><br>
			<input type="text" id="phone_number" name="phone_number" required><br>

    <label>Парола</label><br>
    <input type="password" name="password" placeholder="Парола">
    <p class="error">
      <span>Поне 9 символа</span>
    </p>

    <label>Повторете паролата</label><br>
    <input type="password" name="confirmPassword" placeholder="Повторете паролата">
    
   
    <div >
      <span><button type="submit" class="register_button" name="submit">Регистрирай се</button></span>

    </div>
  </form>
</div>
    </form>
</div>
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

