
// DECLARE GLOBAL VARIABLES HERE
var one;
var two = 2;

//THIS PRINTS A VARIABLE TO THE BROWSER CONSOLE FOR DEBUGGING
console.log(two);


// CODE IN THIS FUNCTION RUNS ON PAGE LOAD
$(function() {
  
  $('#calendar').fullCalendar({
    // put your options and callbacks here
    dayClick: function(date, allDay, jsEvent, view) {

        if (allDay) {
            alert('Clicked on the entire day: ' + date);
        }else{
            alert('Clicked on the slot: ' + date);
        }

        alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

        alert('Current view: ' + view.name);

        // change the day's background color just for fun
        $(this).css('background-color', 'red');

    }
  })

  // test code, saving as example
  //$('#test_link').on('click', goModal);


});



// DECLARE FUNCTIONS HERE

function onIntChange() {
  $('#randomDiv').html('you chose' + $(this).val());
}

// this test modal code wasn't needed.
// may need the scrap later
/*
function goModal() {
  //$('#randomDiv').html('you chose' + $(this).val());
  $('#test_modal').modal('show'); // cool?
  //alert('yo');
}
*/
