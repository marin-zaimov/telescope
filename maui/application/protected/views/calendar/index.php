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

<a href="#" id="blob" class="btn large primary" rel="popover" data-content="And here's some amazing content. It's very engaging. right?" data-original-title="A title">hover for popover</a>

<!-- simple modal example -->
<div id="sample" style="display:none">
  <h2>Sample Data</h2>
  <p>This is some sample data from the current page</p>
  <p>You can press ESC to close this dialog or click <a href="#" class="simplemodal-close">close</a>.</p>

  <div id="modal-calendar"></div>
</div>



<!-- bootstrap example -->

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

<!-- end bootstrap example -->



<div id="calendar"></div>


<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/calendarManager.js"></script>

