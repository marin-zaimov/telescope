
$(function() {
  $('.delete-reservation').on('click', onResDelete);
});


function onResDelete() {
  var id = $(this).data('id');
  var row = $(this).closest('tr');
  $.post('removeMyReservation', {id: id}, function(result) {
    result = $.parseJSON(result);
    if (result.status == true) {
      row.remove();
      Message.flash('Reservation removed succesfully', true);
    }
    else {
      Message.flash('Reservation could not be removed', false, result.messages);
    }
  });
}
