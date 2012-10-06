<?php
/* @var $this CalendarController */

$this->breadcrumbs=array(
	'Calendar',
);
?>

<!-- THIS IS AN HTML COMMENT!!!! -->

<!-- style should typically go into its ows stylesheet (a .css file in application/css/) -->
<style>
  #selectInt {
    width: 300px;
    color: #00FF00;
  }
  #randomDiv {
    width: 500px;
    height: 200px;
    background-color: #000;
    
  }

</style>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>

<select id="selectInt">
<?php foreach (array(1,2,3,4,5) as $int): ?>
  <option value="<?php= $int; ?>" > <?php= $int; ?> </option>
<?php endforeach; ?>
</select>

<div id="randomDiv">
  this is a random div to show how to use css selectors
</div>

<script src="<?php= Yii::app()->request->baseUrl; ?>/js/calendarManager.js"></script>

