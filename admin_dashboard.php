<?php include('templates/header.php');
     include('templates/footer.php');
   
     
    ?> 
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php
$type = $_SESSION['sessionUsertype'];
 if (!isset($_SESSION['sessionId']) || $type != "admin" ) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    }
?>
 
 
   
   

<div class="sidebar">
		<ul>
			<li><a href="#">Dashboard</a></li>
			<li><a href="useroverview.php">Users</a></li>
			<li><a href="productsoverview.php">Products</a></li>
			<li><a href="#">Orders</a></li>
            <li><a href="appointments2.php">Appointments</a></li>
            <li><a href="createcategories.php">Create category</a></li>
		</ul>
	</div>
    <div id="content">
        <div class="flexplacer">
        <div class="adminentrymessage">
    <?php
    if (isset($_SESSION['sessionId'])) {
        echo"WELCOME ";
        echo $type = $_SESSION['sessionUsertype'];
        echo"  ";
        echo $_SESSION['sessionUser'];
        echo"  ";
      
        if($type=="admin"){
        echo '<a href="admin_dashboard.php" class="btnbrand">Admin Dashboard</a>';
        echo'  ';
        echo '<a href="upload.php" class="btnbrand">upload product</a>';
        }
    } else {
        echo "Home";
    }
    ?>
  </div>

    <?php
//phpinfo(); use to show installation of GD
?>
<div id="piechart" class="piechart" style="width: 400px; height: 500px;"></div>


<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);


  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['title', 'quantity'],
      <?php
      $sql = "SELECT title, SUM(quantity) as quantity 
              FROM payment_info 
              GROUP BY title";
      $fire = mysqli_query($db,$sql);
      while ($result = mysqli_fetch_assoc($fire)) {
          echo "['" . $result['title'] . "', " . $result['quantity'] . "],";
      }
      ?>
    ]);
    var options = {
      title: 'Sold product',
    };
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
  } 

 

</script>
      

<?php

$current_year = date("Y");

// Generate data for bar chart
$sql = "SELECT DATE_FORMAT(order_date, '%Y-%m') AS month_year, SUM(price * quantity) AS total_income
        FROM payment_info
        WHERE DATE_FORMAT(order_date, '%Y') = '" . date('Y') . "'
        GROUP BY DATE_FORMAT(order_date, '%Y-%m')
        ORDER BY month_year";
$result = $db->query($sql);

// Generate data table for Google Charts
$dataTable = "['Month', 'Total Income'],";
while ($row = $result->fetch_assoc()) {
    $month_year = $row['month_year'];
    $total_income = (int) $row['total_income'];
    $dataTable .= "['$month_year', $total_income],";
}
$dataTable = rtrim($dataTable, ',');

// Close database connection
$db->close();
?>

<!-- Draw bar chart using Google Charts -->
<div id="chart_div" style="width: 400px; height: 500px;"></div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([<?php echo $dataTable; ?>]);

        var options = {
            title: 'Total Income per Month in 2023',
            hAxis: {
                title: 'Month',
            },
            vAxis: {
                title: 'Total Income',
                minValue: 0,
                format: '$#,###'
            },
            legend: {position: 'none'}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>

<!-- Display the chart in a div -->

</div>
 

</div>
