<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>


<p>This is a temporary site for the maui telescope project!</p>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <code><?php echo __FILE__; ?></code></li>
	<li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
</ul>

<!--<img src="images/MRTC_Telescope.jpeg" width="300" height="300"/>-->
<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>

	