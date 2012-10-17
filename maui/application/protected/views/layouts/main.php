<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->


    <!-- css imports -->
    <!-- FIXME? include fullcalendart.print.css? it's more printer friendly... good for teachers? -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/plugins/fullcalendar.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/maui.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/plugins/bootstrap.min.css" />


  
    <!-- js imports -->
    <!-- FIXME? JQuery files for drag and drop for fullcalendar -->
   <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
   <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/fullcalendar.min.js"></script>
   <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/gcal.js"></script>
   <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/bootstrap.min.js"></script>
   <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/jquery.simplemodal.1.4.3.min.js"></script>

  
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About Us', 'url'=>array('/aboutUs/index')),
				array('label'=>'Telecsope', 'url'=>array('/telescope/index'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Calendar', 'url'=>array('/calendar/index', 'view'=>'about')),
				array('label'=>'User Profile', 'url'=>array('/user/index')),
				array('label'=>'New User', 'url'=>array('/user/ShowUserForm')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
				
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>
	

	

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by Team Teamwork.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
		
		
	
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
