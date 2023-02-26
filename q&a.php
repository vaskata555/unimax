<?php  
include ('templates/header.php');
include ('templates/footer.php');


?>

<!DOCTYPE html>
<html>
<head>
<script src='faq.js'defer></script>
<style>
    .faq-heading{
  border-bottom: #777;
  padding: 20px 60px;
}
.faq-container{
display: flex;
justify-content: center;
flex-direction: column;

}
.hr-line{
width: 82%;
margin: auto;

}
/* Style the buttons that are used to open and close the faq-page body */
.faq-page {
  /* background-color: #eee; */
  color: #444;
  cursor: pointer;
  padding: 30px 20px;
  width: 80%;
  border: none;
  outline: none;
  transition: 0.4s;
  margin: auto;
  background-color:#3E92CC;
}
.faq-body{
  margin: auto;
  /* text-align: center; */
 width: 80%; 
 padding: auto;
 background-color: #F9F9F9;
 
}
/* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
.active,
.faq-page:hover {
  background-color: #F9F9F9;
}
/* Style the faq-page panel. Note: hidden by default */
.faq-body {
  padding: 0 18px;
  background-color: white;
  display: none;
  overflow: hidden;
}
.faq-page:after {
  content: '\02795';
  /* Unicode character for "plus" sign (+) */
  font-size: 13px;
  color: #777;
  float: right;
  margin-left: 5px;
}
.active:after {
  content: "\2796";
}
    </style>
   
</head>
<body>


<h1 class="faq-heading">FAQ</h1>
<section class="faq-container">
    <div class="faq-one">
        <!-- faq question -->
        <h1 class="faq-page">Кои сме ние?</h1>
        <!-- faq answer -->
        <div class="faq-body">
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit saepe sequi, illum facere
                necessitatibus cum aliquam id illo omnis maxime, totam soluta voluptate amet ut sit ipsum
                aperiam.
                Perspiciatis, porro!</p>
        </div>
    </div>
    <hr class="hr-line">
    <div class="faq-two">
        <!-- faq question -->
        <h1 class="faq-page">Защо да ни се довериш?</h1>
        <!-- faq answer -->
        <div class="faq-body">
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit saepe sequi, illum facere
                necessitatibus cum aliquam id illo omnis maxime, totam soluta voluptate amet ut sit ipsum
                aperiam.
                Perspiciatis, porro!</p>
        </div>
    </div>
    <hr class="hr-line">
    <div class="faq-three">
        <!-- faq question -->
<h1 class="faq-page">С какво сме по-добри?</h1>
        <!-- faq answer -->
        <div class="faq-body">
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit saepe sequi, illum facere
                necessitatibus cum aliquam id illo omnis maxime, totam soluta voluptate amet ut sit ipsum
                aperiam.
                Perspiciatis, porro!</p>
        </div>
    </div>
</section>
</div>


</main>
<div class="content">

<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
</body>
</html>