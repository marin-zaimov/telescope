<style>

</style>

<h3 class="page-header">
My reservations
</h3>

<div id="reservationsTable" >
  <?php if (!empty($reservations)): ?>
    <table class="table table-hover table-bordered table-striped">
      <tr>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Viewing Object</th>
        <th></th>
      </tr>
    <?php foreach($reservations as $r): ?>
      <tr>
        <td><?php echo date('m-d-Y h:i a', TimeHelper::toLocalTime($userId, strtotime($r->startTime))); ?></td>
        <td><?php echo date('m-d-Y h:i a', TimeHelper::toLocalTime($userId, strtotime($r->endTime))); ?></td>
        <td><?php echo $r->skyTime->type; ?></td>
        <td><a href="#" class="btn btn-mini btn-danger delete-reservation" data-id="<?php echo $r->id; ?>"><i class="icon-trash"></i> Delete</a></td>
      </tr>
    <?php endforeach; ?>
    </table>
  <?php else: ?>
    You have no reservations to display
  <?php endif; ?>
</div>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/myReservationsManager.js"></script>
