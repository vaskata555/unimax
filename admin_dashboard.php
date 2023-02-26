<?php include('templates/header.php');?>    
<?php
$type = $_SESSION['sessionUsertype'];
 if (!isset($_SESSION['sessionId']) || $type != "admin" ) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    }
?>
 <?php
    if (isset($_SESSION['sessionId'])) {


        echo "Hello user: ";
        echo $_SESSION['sessionUser'];
        echo $type = $_SESSION['sessionUsertype'];
        if($type=="admin"){
        echo '<a href="admin_dashboard.php" class="btnbrand">Admin Dashboard</a>';
        echo'  ';
        echo '<a href="upload.php" class="btnbrand">upload product</a>';
        }
    } else {
        echo "Home";
    }
   
   
?>

<div class="1stadminpanel">
    <p>USER NAVIGATION EDITS AND DELETE</p>
<form action="" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username">

    <label for="email">Email:</label>
    <input type="email" name="email" id="email">

    <input type="submit" name="submit" value="Update">
</form>

<?php
$sql = "SELECT * FROM users1";
$result = mysqli_query($db, $sql);
if (mysqli_num_rows($result) > 0) {
    echo "<table class='1stadminpaneltable'>";
    echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Action</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td><a href='edit_user.php?id=" . $row['id'] ."'class='adminbutton''". "'>Edit</a> | <a href='delete.php?id=" . $row['id'] . "'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No users found.";
}
  ?>
</div>
    <div>
    </div>