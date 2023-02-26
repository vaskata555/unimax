<?php require_once 'templates/dbConfig.php'; ?>
<?php

  $id = $_POST['id'];

  

  
  $sql = "UPDATE images3 SET viewcount = viewcount + ' $viewcount' WHERE id = '$id'";
  $result = mysqli_query($db, $sql);
  
  if ($result) {
    echo json_encode(array("status" => "success"));
  } else {
    echo json_encode(array("status" => "error", "message" => mysqli_error($db)));
  }
?>