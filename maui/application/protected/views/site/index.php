<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>



    
<center><h1>Welcome to the Maui Telescope Project</i></h1></center>


<p>This is a temporary site for the maui telescope project! Please log in or register to access the site </p>
<!-- Feed widget -->
   <?php 
        $this->widget('application.extensions.yii-feed-widget.YiiFeedWidget',
        array('url'=>'http://apod.nasa.gov/apod.rss','limit'=>1)
       );
    ?>



<!--<img src="images/MRTC_Telescope.jpeg" width="300" height="300"/>-->

	
