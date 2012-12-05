
$(function() {
  var userId = $('#userId').val();
  var newUser = (typeof userId == 'undefined');
  
  $('#forgotPassword').click(function(e) {
    e.preventDefault();
    var email = $('#LoginForm_username').val();
    var postData = {email: email};

    $.post('requestTempPassword', postData, function(result) {
      result = $.parseJSON(result);
      if (result.status == true) {

        Message.flash('An email has been sent with a temporary password to: "'+email+'"', true, result.messages);
      }
      else {
        Message.flash('Email not sent', false, result.messages);
      }
      
    });
  });

});
