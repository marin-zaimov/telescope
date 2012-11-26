<style>
  .event-div {
    min-width: 500px;
  }
  .time-div {
    min-width: 200px;
  }

</style>

<h3>
My reservations
</h3>

<div id="reservationsTable" >
  <?php if (!empty($reservation_times)): ?>
    <div class="row-fluid reservation-div">
      <div class="span3 time-div">Time</div>
      <div class="span3">Viewing Object</div>
      <div class="span3">Book It!</div>
    </div>
    <?php foreach($reservation_times as $r): ?>
    <div class="row-fluid event-div">
      <div class="span3 time-div"><?php echo $r->startTimeView .' - '. $r->endTimeView; ?></div>
      <div class="span3"><?php echo $r->event; ?></div>
      <div class="span3"><button id="bookit-btn'+i+'" class="bookit-click btn btn-mini" data-id="<?php echo $r->skyTimeId; ?>" data-starttime="<?php echo $r->startTime; ?>" data-endtime="<?php echo $r->endTime; ?>">Book it!</button></div>
    </div>
    <?php endforeach; ?>
  <?php else: ?>
    There are no events for this day
  <?php endif; ?>
</div>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/seeDayManager.js"></script>
