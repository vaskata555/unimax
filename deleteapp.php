<?php 
 include('templates/header.php');

// Connect to database
 // Check connection
 if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
$id = $_GET['id'];
$sql = "DELETE FROM appointments WHERE id = ?";
$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);


?>
<div class="small-article-other">
  <img src="img\icons8-trash-64.png">
  <h5>Успешно Изтрит</h5>
 
  <b class="info-p">Часът за посещение беше изтрит</b>
  <input type="button" onclick="window.location.href='appointments2.php';" class="submitedituser" value="Go Back">
</div>

</div>
