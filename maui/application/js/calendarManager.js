
// DECLARE GLOBAL VARIABLES HERE
var one;
var two = 2;

//THIS PRINTS A VARIABLE TO THE BROWSER CONSOLE FOR DEBUGGING
console.log(two);


// CODE IN THIS FUNCTION RUNS ON PAGE LOAD
$(function() {
  
  setupCalendar();
  //enablePopover();

});



// DECLARE FUNCTIONS HERE





function setupCalendar() {

  $('#calendar').fullCalendar({
    // put your options and callbacks here

    /* 
      when a day is clicked, offer a popover with the viewable events,
      and have a link to create a reservation
    */
    dayClick: function(date, allDay, jsEvent, view) {

      //alert(date);

      $("#sample").modal({
        minHeight: 2000,
        minWidth: 600,

        // visual affects:
        // append fc-day calendar if wanted
        /*onOpen: function (dialog) {
          dialog.overlay.fadeIn('slow', function () {
            dialog.data.hide();
            dialog.container.fadeIn('slow', function () {
              dialog.data.slideDown('slow');	 

              // fc-day calendar
              //$('#modal-calendar').fullCalendar({
                //defaultView: 'agendaDay',
              //});

            });
          });
        },*/

        position: [50,50],

      });

      $.getJSON('Dash', function(response) {
        //alert(response.names[0]);   // john doe
        alert(response['id']);   // john doe
        //alert(response['id']'changed');   // john doe
      });
      

    },



    dayClickOld: function(date, allDay, jsEvent, view) {
      /* note: 'this' refers to the <td> of the clicked day */

      /* check for and remove old popover */
      var t = $('#cal-popover');
      if (t.length != 0) {
        killPopover(t);
      }
        
      /*
        grab the appropriate td.
        fullcalendar doesn't play nice with positioning bootstrap's popovers.
        the best combination seems to be:
          anything sunday through wednesday, use the NEXT td and position to the right
          anything thursday through saturday, use the CLICKED td and position to the left
        this keeps the popover's bubble pointing to the appropriate day, and it keeps
        it from spilling beyond the window's width
      */
      var day = (''+date).substring(0,3);
      var popPosition;
      if (day == 'Thu' || day == 'Fri' || day == 'Sat') {
        popPosition = 'left';
        $(this).append('<a href="#" id="cal-popover" rel="popover"></a>');
      }
      else {
        popPosition = 'right';
        $(this).next().append('<a href="#" id="cal-popover" rel="popover"></a>');
      }

      /* initialize other popover vars */
      var popTitle = 'Event Title  <a href="#" id="close-popover" style="float:right;">X</a>';
      var popContent = '<h1>Moon </h1><p>Reservation Open</p>';

      /* show the popover */
      $("#cal-popover").popover({
        placement: popPosition,
        title: popTitle,
        content: popContent,
      });
      $('#cal-popover').popover('show');
      setClose(); /* set up event to fire when popover's X box is clicked */

    },


    /*
    eventMouseover: function(event, jsEvent, view) {
      $.getJSON('Dash', function(response) {
        alert(response.names[0]);   // john doe
      });
    },
    */

    // example of events
    events: [
        {
            title: 'an event',
            start: '2012-10-16',
            description: 'This is a cool event'
        }
    ],

    // example of how to move the header
    /*header: {
      left: 'today prev, next',
      center: '',
      right: 'title',
    },*/

  })


}




function setClose() {
  $("#close-popover").on("click", function(event) {
    killPopover($('#cal-popover'));
  });
}


function killPopover(t) {
  t.popover('destroy'); /* kill old popover */
  t.remove(); /* remove element from the DOM */
  $('#close-popover').remove(); /* remove old title */
}





function enablePopover() {

  $(".fc-widget-content").on('hover', function() {

    /* check for and remove old popover */
    var t = $('#cal-popover');
    if (t.length != 0) {
      killPopover(t);
    }
      
    /*
      grab the appropriate td.
      fullcalendar doesn't play nice with positioning bootstrap's popovers.
      the best combination seems to be:
        anything sunday through wednesday, use the NEXT td and position to the right
        anything thursday through saturday, use the CLICKED td and position to the left
      this keeps the popover's bubble pointing to the appropriate day, and it keeps
      it from spilling beyond the window's width
    */
    //var day = (''+date).substring(0,3);
    var popPosition = "left";
    $(this).append('<a href="#" id="cal-popover" rel="popover"></a>');
    /*if (day == 'Thu' || day == 'Fri' || day == 'Sat') {
      popPosition = 'left';
      $(this).append('<a href="#" id="cal-popover" rel="popover"></a>');
    }
    else {
      popPosition = 'right';
      $(this).next().append('<a href="#" id="cal-popover" rel="popover"></a>');
    }*/

    /* initialize other popover vars */
    var popTitle = 'meh title  <a href="#" id="close-popover" style="float:right;">X</a>';
    var popContent = '<h1>h1 content </h1><p>p tag</p>';

    /* show the popover */
    $("#cal-popover").popover({
      placement: popPosition,
      title: popTitle,
      content: popContent,
    });
    $('#cal-popover').popover('show');
    setClose(); /* set up event to fire when popover's X box is clicked */

  });

}
