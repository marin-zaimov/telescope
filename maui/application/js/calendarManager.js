
// CODE IN THIS FUNCTION RUNS ON PAGE LOAD
$(function() {
  
  setupCalendar();
  //enablePopover();

});


function setupCalendar() {

  $('#calendar').fullCalendar({
    // put your options and callbacks here

    /* 
      when a day is clicked, offer a popover with the viewable events,
      and have a link to create a reservation
    */
    dayClick: function(date, allDay, jsEvent, view) {
      var genTime = date.getFullYear()+'-'+(date.getMonth()+1)+'-'+date.getDate();
      var startTime = genTime + ' 00:00:00';
      var endTime = genTime + ' 23:59:59';
      var toServer = {
          'startTime': startTime,
          'endTime': endTime,
      };
      $.post('getEvents', toServer, function(response) {
        Message.popup(response, { onClose: function(dialog) {
            $.modal.close();
            $('#popupModal').html("");
            $('#popupModal').removeClass();
            window.location.href = window.location.href;
          }
        });
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
    events: function() {
      $.get('AllReservations', function(response) {
        var all_events = []
        for (var i = 0; i < response.length; ++i) {
          all_events.append({
            title: response[i].title,
            start: response[i].start,
            description: response[i].description,
          });
        }
        return all_events;
      });
    },
      
    /*  event example
    [
        {
            title: 'an event',
            start: '2012-10-16',
            description: 'This is a cool event'
        }
    ],*/

    // example of how to move the header
    /*header: {
      left: 'today prev, next',
      center: '',
      right: 'title',
    },*/

  })


}

// takes in the id of the bookit button that was clicked
function bookitClick(id, start, end) {

  var payload = {
    'id': id,
    'startTime': start,
    'endTime': end,
  };

  $.post('ReserveEvent', payload, function(data) {
    alert('callback');
  });

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
