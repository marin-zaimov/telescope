
function hasCharacterRequirements(string) {
  if (hasLowercase(string) && hasUppercase(string) && hasNumber(string)) {
    return true;
  }
  else {
    return false;
  }
}
function hasLowercase(string) {
  //var patt=new RegExp("[a-z]", "g");
  var patt=/[a-z]/g;
  return patt.test(string);
}

function hasUppercase(string) {
  var patt=/[A-Z]/g;
  return patt.test(string);
}

function hasNumber(string) {
  var patt=/[0-9]/g;
  return patt.test(string);
}
