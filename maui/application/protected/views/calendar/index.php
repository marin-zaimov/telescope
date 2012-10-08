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

<!--
<p>
<a href="#" id="test_link" data-toggle="modal">Test link</a>
</p>

<div id="test_modal">
  <div class="modal hide fade">
    <div class="modal-header">
      <a class="close" data-dismiss="modal">×</a>
      <h3>Create Dashboard</h3>
    </div>
    <div class="modal-body">
      <p>Test p tag</p>
    </div>
    <div class="modal-footer">
      <a href="#" class="btn cancel-button">Cancel</a>
    </div>
  </div>
</div>
-->


<!-- Button to trigger modal -->
<a href="#myModal" role="button" class="btn" data-toggle="modal">Launch demo modal</a>

<!-- Modal -->
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




<div id="calendar"></div>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/calendarManager.js"></script>

