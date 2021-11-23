<?php require_once('../private/initialize.php');
include(SHARED_PATH .'/header.php'); ?>
<div class="container">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
            <li data-target="#myCarousel" data-slide-to="4"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="images/FestivalAf1.jpg" style="width: 100%; height: 600px">
            </div>

            <div class="item">
                <img src="images/FestivalAf2.jpg" style="width: 100%; height: 600px">
            </div>

            <div class="item">
                <img src="images/FestivalAf3.jpg" style="width: 100%; height: 600px">
            </div>
            <div class="item">
                <img src="images/FestivalAf4.jpg" style="width: 100%; height: 600px">
            </div>
            <div class="item">
                <img src="images/FestivalAf5.jpg" style="width: 100%; height: 600px">
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev" >
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<br>
<h1> Basic Tickets </h1>
<p> Deze tickets zijn erg basic </p>
<br>
<h1> Premium Tickets </h1>
<p> Deze tickets zijn erg premium </p>
<br>
<h1> VIP Tickets </h1>
<p> Deze tickets zijn erg vip </p>
<br>
<?php include(SHARED_PATH .'/footer.php'); ?>

