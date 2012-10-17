
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

        /*if (allDay) {
            alert('Clicked on the entire day: ' + date);
        }else{
            alert('Clicked on the slot: ' + date);
        }*/
        //alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
        //alert('Current view: ' + view.name);

        // change the day's background color just for fun
        //$(this).css('background', 'url(../images/turtle.jpg)');
        //$(this).css('background-color', 'red');

        $("#sample").modal({
          minHeight: 2000,
          minWidth: 600,
          //onClose: function() {
            //alert('sup');
          //},

          onOpen: function (dialog) {
            dialog.overlay.fadeIn('slow', function () {
              dialog.data.hide();
              dialog.container.fadeIn('slow', function () {
                dialog.data.slideDown('slow');	 
                $('#modal-calendar').fullCalendar({
                  defaultView: 'agendaDay',
                });

              });
            });
          },

          position: [50,50],


        });

        


    },

    eventMouseover: function(event, jsEvent, view) {
      //alert('moused over');
      //$(".fc-event").css('background-color);
    },

    // example of events

    events: [
        {
            title: 'an event',
            start: '2012-10-16',
            description: 'This is a cool event'
        },/*{
            title: 'My Event',
            start: '2012-10-10',
            description: 'This is a cool event'
        },{
            title: 'My Event',
            start: '2012-10-10',
            description: 'This is a cool event'
        },{
            title: 'My Event',
            start: '2012-10-10',
            description: 'This is a cool event'
        },{
            title: 'My Event',
            start: '2012-10-10',
            description: 'This is a cool event'
        },{
            title: 'My Event',
            start: '2012-10-10',
            description: 'This is a cool event'
        }*/

    ],

    // example of how to move the header
    /*header: {
      left: 'today prev, next',
      center: '',
      right: 'title',
    },*/

  })

  

  // test code for bootstrap pop-ups
  //$("#blob").popover({offset: 10});



});



// DECLARE FUNCTIONS HERE

function onIntChange() {
  //$('#randomDiv').html('you chose' + $(this).val());
}

