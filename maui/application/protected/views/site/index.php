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





<div id= "myCarousel" class="carousel slide">
	<div class="carousel-inner">
		<div class="active item">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/howey.jpg" alt="howey" width="200" height="128">
			<div class="carousel-caption">
				<h4> First Label Here </h4>
				<p>
				"First flavor text here."
				</p>
			</div>
		</div>
	<div class="item">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/moon_phases.jpg" alt="moon_phases" width="200" height="128">
			<div class="carousel-caption">
				<h4> SecondLabel Here </h4>
				<p>
				"Second flavor text here."
				</p>
			</div>
		</div>
		<div class="item">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/MRTC_Telescope.jpeg" alt="MRTC_Telescope" width="200" height="128">
			<div class="carousel-caption">
				<h4> Third Label Here </h4>
				<p>
				"Third flavor text here."
				</p>
			</div>
		</div>
		<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
	</div>
</div>
  
        <!-- Javascript placed at the end of the document so the pages load faster -->

        <script src="bootstrap/jquery.js"></script>	

        <script src="bootstrap/bootstrap.js"></script>

        <script src="bootstrap/bootstrap-alert.js"></script>

        <script src="bootstrap/bootstrap-carousel.js"></script>

        <script src="bootstrap/bootstrap-transition.js"></script>


        <script type="text/javascript">

        $('.carousel').carousel("cycle")

        

        </script>
