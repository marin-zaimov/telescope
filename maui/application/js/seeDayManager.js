
$(function() {

  $('.bookit-click').on('click', function() {

    var data = {'reservation' : {
        'skyTimeId' : $(this).data('id'),
        'startTime' : $(this).data('starttime'),
        'endTime' : $(this).data('endtime')
    }};

    bookitClick(data);
  });
});

function bookitClick(data) {

  $.post('reserveEvent', data, function(result) {
    result = $.parseJSON(result);
    if (result.status == true) {
      Message.flash('Reservation created succesfully', true);
    }
    else {
      Message.flash('Reservation could not be created', false, result.messages);
    }
  });
}
