<style>

</style>

<h3 class="page-header">
My reservations
</h3>

<div id="reservationsTable" >
  <?php if (!empty($reservations)): ?>
    <table class="table table-hover table-bordered table-striped">
      <tr>
        <th>Date</th>
        <th>Time</th>
        <th>Viewing Object</th>
        <th></th>
      </tr>
    <?php foreach($reservations as $r): ?>
      <tr>
        <td><?php echo date('F j', TimeHelper::toLocalTime($userId, strtotime($r->startTime))); ?></td>
        <td><?php echo date('h:i a', TimeHelper::toLocalTime($userId, strtotime($r->startTime))).' - '.date('h:i a', TimeHelper::toLocalTime($userId, strtotime($r->endTime))); ?></td>
        <td><?php echo $r->skyTime->type; ?></td>
        <td><a href="#" class="btn btn-mini btn-danger delete-reservation" data-id="<?php echo $r->id; ?>"><i class="icon-trash icon-white"></i> Delete</a></td>
      </tr>
    <?php endforeach; ?>
    </table>
  <?php else: ?>
    You have no reservations to display
  <?php endif; ?>
</div>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/myReservationsManager.js"></script>
