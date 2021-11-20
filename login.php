<?php
require_once 'templates/header.php';
?>

<div>
   
    <p> LOGIN HERE! </p>

    <form action="templates/login-inc.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit" name="submit">LOGIN</button>
    </form>
</div>
<?php
require_once 'templates/footer.php';
?>

