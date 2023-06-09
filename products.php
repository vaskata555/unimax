<?php include('templates/header.php');
  
    
    ?> 
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="js/bootstrap.min.js"></script>
<div class="product-page-wrapper">
<div class="filterbox">
    <div class="priceslider">
    <h3>Price</h3>
                    <input type="hidden" id="min_price_hide" value="0" />
                    <input type="hidden" id="max_price_hide" value="2000" />
                    <p id="price_show">1 - 2000</p>
                    <div id="price_range" style="width:10vw"></div>
                </div>
                
    <div id="categories">
        <label for="category">Categories:</label>
        <?php
        $categories = array();

        $result = mysqli_query($db, "SELECT DISTINCT images3.id,images3.image,images3.short_desc,images3.price,images3.category_id,category.category_name FROM images3 
    JOIN category ON category.id = images3.category_id ");
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[$row['category_id']] = $row['category_name'];
        }

        foreach ($categories as $id => $name)  {
            echo "<div class='category'><input type='checkbox' id='categories'class='category_checkbox' value=". $id .">";
            echo '<label for="' . $id . '">' . $name . '</label></div>';
        }
        ?>
    </div>
    <div id="brands">
        <label for="brand">brand:</label>
        <?php
      $brands = array();

      $result = mysqli_query($db, "SELECT DISTINCT brand FROM images3");
      
      while ($row = mysqli_fetch_assoc($result)) {
          $brands[] = $row['brand'];
      }

        foreach ($brands as $brand)  {
            echo "<div class='brand'><input type='checkbox' id='brands'class='brand_checkbox' value=". $brand .">";
            echo '<label for="' . $brand . '">' . $brand . '</label></div>';
        }
        ?>
    </div>
    </div>
<script>
         function filterProducts() {
        var action = 'fetch_data';
        var priceMin = $("#min_price_hide").val();
        var priceMax = $("#max_price_hide").val();
        var selectedCategories = [];
        var brands = [];

$(".category_checkbox:checked").each(function () {
    selectedCategories.push($(this).val());
});
$(".brand_checkbox:checked").each(function () {
   brands.push($(this).val());
});

$.ajax({
    url: "filter_data.php",
    type: "POST",
    data: {
        action: action,
    priceMin: priceMin,
    priceMax: priceMax,
    categories: selectedCategories,
    brands: brands

    },
    success: function (response) {
        $('#results').html(response);
    }
});
}

$(document).ready(function () {
filterProducts();

$('#price_range').slider({
    range: true,
    min: 1,
    max: 2000,
    values: [1, 2000],
    step: 1,
    stop: function (event, ui) {
        $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
        $('#min_price_hide').val(ui.values[0]);
        $('#max_price_hide').val(ui.values[1]);
        filterProducts();
    }
});
$(".brand_checkbox").change(function () {
    filterProducts();
});
// Handle category checkbox change
$(".category_checkbox").change(function () {
    filterProducts();
});
});
</script>


<div class="container1products ">

     <div class="filter_results" id="results">
    </div></div></div></div>
    <?    include('templates/footer.php'); ?>