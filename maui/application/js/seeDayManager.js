
$(function() {

  $('.bookit-click').on('click', bookitClick);
  
  $('.delete-reservation').on('click', onResDelete);
});

function resetBookClick() {
  $('.bookit-click').off('click', bookitClick);
  $('.bookit-click').on('click', bookitClick);
}

function resetDeleteClick() {
  $('.delete-reservation').off('click', onResDelete);
  $('.delete-reservation').on('click', onResDelete);
}

function bookitClick() {
  var bookButton = $(this);
  var deleteButton = bookButton.parent().find('.delete-reservation');
  var data = {'reservation' : {
      'skyTimeId' : bookButton.data('id'),
      'startTime' : bookButton.data('starttime'),
      'endTime' : bookButton.data('endtime')
  }};
  
  $.post('reserveEvent', data, function(result) {
    result = $.parseJSON(result);
    if (result.status == true) {
      bookButton.hide();
      deleteButton.attr('data-id', result.data.reservationId);
      deleteButton.show();
      Message.flash('Reservation created succesfully', true);
    }
    else {
      Message.flash('Reservation could not be created', false, result.messages);
    }
  });
}

function onResDelete() {
  var deleteButton = $(this);
  console.log(deleteButton);
  var bookButton = deleteButton.parent().find('.bookit-click');
  var id = deleteButton.attr('data-id');
  $.post('removeMyReservation', {id: id}, function(result) {
    result = $.parseJSON(result);
    if (result.status == true) {
      bookButton.show();
      deleteButton.attr('data-id', '');
      deleteButton.hide();
      Message.flash('Reservation removed succesfully', true);
    }
    else {
      Message.flash('Reservation could not be removed', false, result.messages);
    }
  });
}
