<style>
  .reservation-div {
    
  }

</style>


<h3>
My reservations
</h3>

<div id="reservationsTable" >
  <?php foreach($reservations as $r): ?>
  <div class="row-fluid reservation-div">
    <div class="span3"><?php echo date('m-d-Y h:i a', strtotime($r->startTime)); ?></div>
    <div class="span3"><?php echo date('m-d-Y h:i a', strtotime($r->endTime)); ?></div>
    <div class="span3"><?php echo $r->skyTime->type; ?></div>
    <div class="span3"><a href="#" class="delete-reservation" data-id="<?php echo $r->id; ?>"><i class="icon-trash"></i> Delete</a></div>
  </div>
  <?php endforeach; ?>
</div>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/myReservationsManager.js"></script>
