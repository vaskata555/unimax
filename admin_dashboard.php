<?php include('templates/header.php');
     
   
     
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
			<li><a href="admin_dashboard.php">Админ Панел</a></li>
      <li> <a href="upload.php">Качи продукт</a></li>
			<li><a href="useroverview.php">Потребители</a></li>
			<li><a href="productsoverview.php">Продукти</a></li>
			<li><a href="orderoverview.php">Поръчки</a></li>
            <li><a href="appointments2.php">Заявки</a></li>
            <li><a href="createcategories.php">Създай категория</a></li>
            <li><a href="createbrand.php">Създай марка</a></li>
           
		</ul>
	</div>
  <div class="wrapwhite">
    <div id="content">
        <div class="flexplacer">
        <div class="adminentrymessage">
    <?php
    if (isset($_SESSION['sessionId'])) {
        echo"Здравейте ";
        echo $type = $_SESSION['sessionUsertype'];
        echo"  ";
        echo $_SESSION['sessionUser'];
        echo"  ";
      
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
      $sql = "SELECT products.title, SUM(order_details.quantity) as quantity             
              FROM order_details 
              JOIN products ON order_details.id_product = products.id  
              GROUP BY products.title";
      $fire = mysqli_query($db,$sql);
      while ($result = mysqli_fetch_assoc($fire)) {
          echo "['" . $result['title'] . "', " . $result['quantity'] . "],";
      }
      ?>
    ]);
    var options = {
      title: 'най-продавани продукти',
    };
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
  } 

 

</script>
      

<?php

$current_year = date("Y");

// Generate data for bar chart
$sql = "SELECT DATE_FORMAT(o.order_date, '%Y-%m') AS month_year, SUM(od.price * od.quantity) AS total_income
        FROM orders o
        JOIN order_details od ON o.order_number = od.order_number
        WHERE DATE_FORMAT(o.order_date, '%Y') = YEAR(CURDATE())
        GROUP BY DATE_FORMAT(o.order_date, '%Y-%m')
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

?>

<!-- Draw bar chart using Google Charts -->
<div id="chart_div" class="chart_div" style="width: 400px; height: 500px;"></div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([<?php echo $dataTable; ?>]);

        var options = {
            title: 'Приходи за месец',
            hAxis: {
                title: 'месец',
            },
            vAxis: {
                title: 'тотал приходи',
                minValue: 0,
                format: 'лв#,###'
            },
            legend: {position: 'none'}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>

<!-- Display the chart in a div -->
<div id="piechart1" name="piechart1" class="piechart1" style="width: 400px; height: 500px;"></div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart1);

  function drawChart1() {
    var data1 = google.visualization.arrayToDataTable([
      ['title', 'quantity'],
      <?php
      // Assuming you have established a database connection named $db
      $sql = "SELECT b.brand, SUM(od.quantity) AS quantity
      FROM order_details AS od
      JOIN products AS p ON od.code = p.code
      JOIN brands AS b ON p.brand_id = b.id
      GROUP BY b.brand;";
      $fire = mysqli_query($db, $sql);
      while ($result = mysqli_fetch_assoc($fire)) {
          echo "['" . $result['brand'] . "', " . $result['quantity'] . "],";
      }
      ?>
    ]);

    var options1 = {
      title: 'Най-продавани марки',
    };

    var chart1 = new google.visualization.PieChart(document.getElementById('piechart1'));
    chart1.draw(data1, options1);
  } 
</script>
</div>
</div>