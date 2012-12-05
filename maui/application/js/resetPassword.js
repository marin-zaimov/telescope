$(document).ready(function(){
  
  jQuery.validator.addMethod("validPassword", function(value, element) { 
    return hasCharacterRequirements(value); 
  }, "<ul>Your password must contain: <li>at least 1 lower case letter</li><li>one uppercase letter</li><li>one number</li></ul>");

  $('#pw_reset_form').validate({
    errorClass: 'error',
    validClass: 'valid',
    rules: {
      'User[email]': { required: true, email: true },
      'User[tempPassword]': { required: true },
      'User[newPassword]': { required: true, rangelength: [9, 31], validPassword: true },
      'User[newPasswordConfirm]': { equalTo: "#newPassword" }
    },
    highlight: function(element) {
      $(element).closest('div').addClass("f_error");
    },
    unhighlight: function(element) {
      $(element).closest('div').removeClass("f_error");
    },
    errorPlacement: function(error, element) {
      $(element).closest('div').append(error);
    }
  });
});
