
$(function() {
alert('ha');
  //$('#saveUser').on('click', saveUser);
  $('#userForm').submit(function() {
  saveUser($(this).serialize());
  return false;
});
});



// DECLARE FUNCTIONS HERE

function saveUser(data) {
  $.post('saveUser', data, function(result) {
    result = $.parseJSON(result);
    if (result.status == true) {
      $('#userForm').html('User saved succesfully!');
      Message.flash('User saved succesfully', true);
    }
    else {
      Message.flash('User could not be saved', false, result.messages);
    }
  });
}
