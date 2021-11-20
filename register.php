<?php
require_once 'templates/header.php';
?>

<div>
    
    <form action="templates/register-inc.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="confirmPassword" placeholder="Confirm password">
        <button type="submit" name="submit">REGISTRER</button>
    </form>
</div>

<?php
require_once 'templates/footer.php';
?>

