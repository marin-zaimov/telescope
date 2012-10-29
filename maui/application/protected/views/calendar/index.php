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
<!-- <h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>-->
<h1>Calendar</h1>
<p>Select a day to see the available reservations</h1>
<p>Click here to filter the events</h1>







<!-- popover example -->
<!-- <a href="#" id="blob" class="btn large primary" rel="popover" data-content="And here's some amazing content. It's very engaging. right?" data-original-title="A title">hover for popover</a> -->


<!--<p id="popoverTitle" style="display:none;">meh title<a href="#" id="close-popover" style="float:right;">X</a>-->



<!-- simple modal example -->
<div id="sample" style="display:none;">

  <h4><a href="#" class="simplemodal-close" style="float:right;">X</a></h4>
  <h2 id="modal-day"></h2>
  <p>TODO Summarize the viewing times here?</p>
  <div class="accordion" id="accordion2"></div>


</div>






<!--
bootstrap example

  ...Button to trigger modal..
  <a href="#myModal" role="button" class="btn" data-toggle="modal">Launch demo modal</a>

  ..Modal..
  <div class="modal hide" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">Modal header</h3>
    </div>
    <div class="modal-body">
      <p>One fine body…</p>
    </div>
    <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
      <button class="btn btn-primary">Save changes</button>
    </div>
  </div>

  end bootstrap example
-->


<div id="calendar"></div>


<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/calendarManager.js"></script>

