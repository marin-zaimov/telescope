
// DECLARE GLOBAL VARIABLES HERE
var one;
var two = 2;

//THIS PRINTS A VARIABLE TO THE BROWSER CONSOLE FOR DEBUGGING
console.log(two);


// CODE IN THIS FUNCTION RUNS ON PAGE LOAD
$(function() {
  one = 1;
  //keeps track of changes to the slect bar and runs a function on change
  $('#selectInt').on('change', onIntChange);
});



// DECLARE FUNCTIONS HERE

function onIntChange() {
  $('#randomDiv').html('you chose' + $(this).val());
}
