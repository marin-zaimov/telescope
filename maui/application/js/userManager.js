
$(function() {
  //$('#saveUser').on('click', saveUser);
  $('#userForm').submit(function(e) {
    e.preventDefault();
    saveUser($(this).serialize());
    return false;
  });
});



// DECLARE FUNCTIONS HERE

function saveUser(data, newUser) {
  $.post('saveUser', data, function(result) {
    Message.clearStickys();
    result = $.parseJSON(result);
    if (result.status == true) {
    if (newUser) {
      $('#content').html('Thank you for registering. You will receive an email with a confirmation shortly.');
    }
      Message.flash('User saved succesfully', true);
    }
    else {
      Message.flash('User could not be saved', false, result.messages);
    }
  });
}
