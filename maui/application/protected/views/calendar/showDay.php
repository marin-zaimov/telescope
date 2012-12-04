<style>
  #reservationsDiv {
    min-width: 600px;
  }
  .table tr th {
    background-color: #C3D9FF;
  }
</style>

<h3 class="page-header">
<?php echo $titleLabel; ?> - Viewing Times
</h3>

<div id="reservationsDiv" >
  <?php if (!empty($reservation_times)): ?>
    <table class="table table-hover table-bordered table-striped">
      
      <tr>
        <th class="time-div">Time</th>
        <th>Viewing Object</th>
        <th>Status</th>
      </tr>
      
      <?php foreach($reservation_times as $r): ?>
      <tr>
        <td class="time-div"><?php echo $r->startTimeView .' - '. $r->endTimeView; ?></th>
        <td><?php echo $r->event; ?></th>
        <td>
          <?php if (!empty($r->reservation)): ?>
            <?php if($r->reservation->userId == Yii::app()->user->id): ?>
            <a href="#" class="btn btn-mini btn-danger delete-reservation" data-id="<?php echo $r->reservation->id; ?>"><i class="icon-trash icon-white"></i> Unbook it</a>
            <button style="display: none;" class="bookit-click btn btn-primary btn-mini" data-id="<?php echo $r->skyTimeId; ?>" data-starttime="<?php echo $r->startTime; ?>" data-endtime="<?php echo $r->endTime; ?>"><i class="icon-ok icon-white"></i> Book it</button>
            <?php else: ?>
            <span>Booked by <?php echo $r->bookedByUser->organization.' - '.$r->bookedByUser->firstName; ?></span>
            <?php endif; ?>
          <?php else: ?>
            <button class="bookit-click btn btn-primary btn-mini" data-id="<?php echo $r->skyTimeId; ?>" data-starttime="<?php echo $r->startTime; ?>" data-endtime="<?php echo $r->endTime; ?>"><i class="icon-ok icon-white"></i> Book it</button>
            <a href="#" style="display: none;" class="btn btn-mini btn-danger delete-reservation" data-id=""><i class="icon-trash icon-white"></i> Unbook it</a>
          <?php endif; ?>
        </td>
      </tr>
      <?php endforeach; ?>
    
    </table>
  <?php else: ?>
    There are no events for this day
  <?php endif; ?>
</div>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/seeDayManager.js"></script>


