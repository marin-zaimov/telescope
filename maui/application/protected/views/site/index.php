<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
 /*$this->widget('application.extensions.yii-feed-widget.YiiFeedWidget',
        array('url'=>'http://apod.nasa.gov/apod.rss','limit'=>3)
       ); */
?>


<style>
	.carousel-inner { text-align: center; }

	.carousel .item > img { display: inline-block; }
</style>
    
<h3 class="page-header">Welcome to the Maui Telescope Project</h3>


 <div id="myCarousel" class="carousel slide">
    <!-- Carousel items -->
        <div class="carousel-inner">
        
            <div class="active item"> 
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/howey320.jpg" alt="howey" width="auto" height="auto">
            <h4> Howey Physics Building </h4>
				<p>
				"Location of the Georgia Tech Observatory!."
				</p>
            </div>
        
            <div class="item"> 
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/moon_phases320.jpg" alt="moon_phases" width="auto" height="auto">
            <h4> Phases of the Moon </h4>
				<p>
				Make a reservation to see the moon today!
				</p>
            </div>
            
            <div class="item">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/MRTC_Telescope320.jpg" alt="MRTC_Telescope" width="auto" height="auto">
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
