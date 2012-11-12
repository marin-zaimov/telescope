<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
 /*$this->widget('application.extensions.yii-feed-widget.YiiFeedWidget',
        array('url'=>'http://apod.nasa.gov/apod.rss','limit'=>3)
       ); */
?>

<!--
<style>
	.carousel-inner .item {margin-right:auto, margin-left:auto}
</style>
-->
    
<center><h1><i>Welcome to the Maui Telescope Project</i></h1></center>


<p>This is a temporary site for the maui telescope project! Please log in or register to access the site </p>



 <div id="myCarousel" class="carousel slide">
    <!-- Carousel items -->
        <div class="carousel-inner">
        
            <div class="active item"> 
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/howey.jpg" alt="howey" width="900" height="50">
            <h4> Howey Physics Building </h4>
				<p>
				"Location of the Georgia Tech Observatory!."
				</p>
            </div>
        
            <div class="item"> 
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/moon_phases.jpg" alt="moon_phases" width="900" height="50">
            <h4> Phases of the Moon </h4>
				<p>
				Make a reservation to see the moon today!
				</p>
            </div>
            
            <div class="item">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/MRTC_Telescope.jpeg" alt="MRTC_Telescope" width="900" height="50">
            <h4> MRTC Telescope </h4>
				<p>
				Check out the specs on this awesome telescope.
				</p>
            </div>
       </div>
            <!-- Carousel nav -->
                <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
       </div>
       
       <script>
       $('.carousel').carousel("cycle")
       
       </script>
