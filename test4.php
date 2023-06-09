<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
      
        <form method="post">
  <label for="first_select">First Select:</label>
  <select id="first_select" name="first_select" onchange="this.form.submit()">
    <option value="">--Select--</option>
    <?php
    include 'dbConfig.php';
        $sql = "SELECT * FROM Position";
                $result= mysqli_query($dbConn, $sql);
                while ($row = mysqli_fetch_array($result)) 
                {
                    echo "<option value='{$row['ID_POSITION']}'";
      if (isset($_POST['first_select']) && $_POST['first_select'] == $row['ID_POSITION']) {
        echo " selected";
      }
      echo ">{$row['Position_name']}</option>";
    }

    ?>
  </select>

  <label for="second_select">Second Select:</label>
  <select id="second_select" name="second_select">
    <option value="">--Select--</option>
    <?php
     include 'config.php';
    // Populate options of the second select tag based on the selected option of the first select tag
    if (isset($_POST['first_select'])) {
      $query = "SELECT * FROM employee WHERE POSITION_ID_POSITION = {$_POST['first_select']}";
      $result = mysqli_query($dbConn, $query);
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='{$row['ID_EMPLOYEE']}'";
        if ($_POST['second_select'] == $row['ID_EMPLOYEE']) {
          echo " selected";
        }
        echo ">{$row['Employee_name']}</option>";
      }
    }
    ?>
  </select>
  
  <input type="submit" value="Submit">
</form>

       
    </body>
</html>
