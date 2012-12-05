
$(function() {
  var userId = $('#userId').val();
  var newUser = (typeof userId == 'undefined');
  
  $('#userForm').submit(function(e) {
    e.preventDefault();
    saveUser($(this).serialize(), newUser);
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
      $('#content').html('Thank you for creating a new user. We have sent you an email. Please click on the link in your email to verif your account');
    }
      Message.flash('User saved succesfully', true);
    }
    else {
      Message.flash('User could not be saved', false, result.messages);
    }
  });
}
