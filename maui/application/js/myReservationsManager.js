
$(function() {
  one = 1;
  //keeps track of changes to the slect bar and runs a function on change
  $('.delete-reservation').on('click', onResDelete);
});



// DECLARE FUNCTIONS HERE

function onResDelete() {
  var id = $(this).data('id');
  var row = $(this).closest('.reservation-div');
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
