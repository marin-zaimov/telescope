
// DECLARE GLOBAL VARIABLES HERE
var one;
var two = 2;

//THIS PRINTS A VARIABLE TO THE BROWSER CONSOLE FOR DEBUGGING
console.log(two);


// CODE IN THIS FUNCTION RUNS ON PAGE LOAD
$(function() {
  
  $('#calendar').fullCalendar({
    // put your options and callbacks here
  })


});



// DECLARE FUNCTIONS HERE

function onIntChange() {
  $('#randomDiv').html('you chose' + $(this).val());
}
