<style>
  #reservationsTable {
    min-width: 600px;
  }
</style>

<h3 class="page-header">
My reservations
</h3>

<div id="reservationsTable" >
  <?php if (!empty($reservation_times)): ?>
    <table class="table table-hover table-bordered table-striped">
      <tr>
        <th class="time-div">Time</th>
        <th>Viewing Object</th>
        <th>Book It!</th>
      </tr>
      <?php foreach($reservation_times as $r): ?>
      <tr>
        <th class="time-div"><?php echo $r->startTimeView .' - '. $r->endTimeView; ?></th>
        <th><?php echo $r->event .' - '. $r->booked; ?></th>
        <th><button id="bookit-btn'+i+'" class="bookit-click btn btn-primary btn-mini" data-id="<?php echo $r->skyTimeId; ?>" data-starttime="<?php echo $r->startTime; ?>" data-endtime="<?php echo $r->endTime; ?>">Book it!</button></th>
      </tr>
    <?php endforeach; ?>
    </table>
  <?php else: ?>
    There are no events for this day
  <?php endif; ?>
</div>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/seeDayManager.js"></script>
