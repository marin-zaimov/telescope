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
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/plugins/bootstrap-responsive.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/plugins/sticky.css" />  	
  <style>
      body {
        padding-top: 60px; /* When using the navbar-top-fixed */
      }
      .navbar-inner {
        background-color: #222;
        background-image: -moz-linear-gradient(top,#222,#111);
        background-image: -webkit-gradient(linear,0 0,0 100%,from(#222),to(#111));
        background-image: -webkit-linear-gradient(top,#222,#111);
        background-image: -o-linear-gradient(top,#222,#111);
        background-image: linear-gradient(to bottom,#222,#111);
        background-repeat: repeat-x;
        border: 1px solid #444;
        border-top: 0;
      }
      #page {
        margin-top: -20px;
        margin-bottom: 5px;
        background: white;
        border: 1px solid #CCC;
      }
      .navbar .nav > .active > a, .navbar .nav > .active > a:hover, .navbar .nav > .active > a:focus {
        color: #FFF;
        background-color: #000;
      }
      .navbar .nav > li > a {
        text-shadow: none;
      }
      .navbar .nav > li a:hover {
        color: #FFF;
      }
      .navbar .nav li.dropdown.open > .dropdown-toggle, .navbar .nav li.dropdown.active > .dropdown-toggle, .navbar .nav li.dropdown.open.active > .dropdown-toggle {
        color: #FFF;
        background-color: #000;
      }
  </style>


  
    <!-- js imports -->
    <!-- FIXME? JQuery files for drag and drop for fullcalendar -->
   <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
   <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/fullcalendar.min.js"></script>
   <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/gcal.js"></script>
   <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/sticky.min.js"></script>
   <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/bootstrap.min.js"></script>
   <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/jquery.simplemodal.1.4.3.min.js"></script>
   <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/MauiBase.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<?php
  $urls = array(
    'home' => array('name' => 'Home', 'url' => Yii::app()->request->baseUrl .'/index.php/site/index'),
    'about' => array('name' => 'About', 'url' => Yii::app()->request->baseUrl .'/index.php/aboutUs/index'),
    'telescope' => array('name' => 'Telescope', 'url' => Yii::app()->request->baseUrl .'/index.php/telescope/index'),
    'login' => array('name' => 'Login/Register', 'url' => Yii::app()->request->baseUrl .'/index.php/site/login'),
    'logout' => array('name' => 'Logout ('.Yii::app()->user->name.')', 'url' => Yii::app()->request->baseUrl .'/index.php/site/logout'),
    'calendar' => array('name' => 'Calendar', 'url' => Yii::app()->request->baseUrl .'/index.php/calendar/index'),
    'profile' => array('name' => 'My Profile', 'url' => Yii::app()->request->baseUrl .'/index.php/user/profile'),
    'reservations' => array('name' => 'My Reservations', 'url' => Yii::app()->request->baseUrl .'/index.php/calendar/myReservations'),
  );
    
  function createNavLi($index, $urls) {
    $class = (strpos($_SERVER['REQUEST_URI'], $urls[$index]['url'])===0) ? 'active' : '';

    $result = '<li class="'.$class.'"><a href="'.$urls[$index]['url'].'">'.$urls[$index]['name'].'</a></li>';

    return $result;
  }
?>
<body>

<div class="container" id="page">
  <div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand" href="#">Maui Telescope</a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <?php echo createNavLi('home', $urls); ?>
          <?php echo createNavLi('about', $urls); ?>
          <?php echo createNavLi('telescope', $urls); ?>
        <?php if (Yii::app()->user->isGuest): ?>
          <?php echo createNavLi('login', $urls); ?>
        <?php else: ?> 
          <?php echo createNavLi('calendar', $urls); ?>
          <li class="dropdown <?php echo ((strpos($_SERVER['REQUEST_URI'], $urls['profile']['url'])===0) || (strpos($_SERVER['REQUEST_URI'], $urls['reservations']['url'])===0)) ? 'active' : ''; ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <?php echo createNavLi('profile', $urls); ?>
              <?php echo createNavLi('reservations', $urls); ?>
            </ul>
          </li>
          <?php echo createNavLi('logout', $urls); ?>
        <?php endif; ?>
        </ul>
      </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
  </div><!-- /.navbar-inner -->
</div><!-- /.navbar -->

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>
	

	

	<div class="clear"></div>

</div><!-- page -->

</body>
</html>
