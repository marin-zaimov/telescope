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

<p>
<a href="#" id="test_link">Test link</a>
</p>

<div id="test_modal">
  <div class="modal fade">
    <div class="modal-header">
      <a class="close" data-dismiss="modal">×</a>
      <h3>Create Dashboard</h3>
    </div>
    <div class="modal-body">
      <form class="form-inline">
        <label>Name:
          <input type="input"></input>
        </label>
      </form>
    </div>
    <div class="modal-footer">
      <a href="#" class="btn cancel-button">Cancel</a>
      <a href="#" class="btn btn-primary create-button">Create</a>
    </div>
  </div>
</div>



<div id="calendar"></div>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/calendarManager.js"></script>

