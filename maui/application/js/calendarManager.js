
// CODE IN THIS FUNCTION RUNS ON PAGE LOAD
$(function() {
  
  setupCalendar();
  //enablePopover();

  setupHighlightBtns();
  setupFCBtns();




});
var highlight_btns = [
    '#moon-filter',
    '#jupiter-filter',
    '#saturn-filter',
    '#m13-filter',
    '#m15-filter',
    '#m31-filter',
    '#m42-filter',
    '#m57-filter',
    '#m81-filter',
  ];


  
function setupCalendar() {

  $('#calendar').fullCalendar({
    // put your options and callbacks here

    /* 
      when a day is clicked, offer a popover with the viewable events,
      and have a link to create a reservation
    */
    dayClick: function(date, allDay, jsEvent, view) {
      globalDayClick(date, allDay, jsEvent, view);
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

     
    events: function(start, end, callback) {

      $.ajax({
        url: 'AllReservations',
        dataType: 'json',
        data: {
          startTime: Math.round(start.getTime() / 1000),
          endTime: Math.round(end.getTime() / 1000)
        },
        success: function(reservations) {
          var all_events = []
          for (var i = 0; i < reservations.length; ++i) {
            all_events.push({
              title: reservations[i].title,
              start: reservations[i].start,
              description: reservations[i].description,
              color: reservations[i].color,
              object: reservations[i].object,
              id: 'sky_event'+i,
            });
          }
          window.all_events = all_events;
          callback(all_events);
        }
      });
    },


    /*
    eventRender: function(the_event, element) {
        element.popover({
            content: the_event.description
        });
        element.popover('show');
    },*/


    eventClick: function(calEvent, jsEvent, view) {
      globalDayClick(calEvent.start, true, jsEvent, view);
    },

  })


}


function globalDayClick(date, allDay, jsEvent, view) {
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
        //window.location.href = window.location.href;
        //location.reload();
        $('#calendar').fullCalendar('refetchEvents');
      }
    });
  });

}


function setupHighlightBtns() {

  for (var i = 0; i < window.highlight_btns.length; i++) {
    $(window.highlight_btns[i]).click(highlightDays);
  }
      
    
}

function clearHighlights() {

  $('td').css('background-color','white');
  for (var i = 0; i < window.highlight_btns.length; i++) {
    $(window.highlight_btns[i]).attr('class','btn');
  }
}


function highlightDays(e) {
  var el_id = $(e.currentTarget).attr("id");
  if (el_id == undefined)
    el_id = e;
  //alert(el_id);
  var btn_name = $('#'+el_id).text();

  for (var i = 0; i < window.all_events.length; i++) {
    if (window.all_events[i].object == btn_name) {
      if ($('#'+el_id).attr('class').indexOf('active') == -1) {
        $(findFullCalendarDayForClickedEvent(window.all_events[i].start)).css('background-color','red');
      }
      else {
        $(findFullCalendarDayForClickedEvent(window.all_events[i].start)).css('background-color','white');
      }
    }
  }


}

function setupFCBtns() {
  $('.fc-button').click(clearHighlights);

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
    else {*
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

/*
 * ripped from stack overflow post by jthiesse
 */
function findFullCalendarDayForClickedEvent(eventDate) {

  var foundDay;

  var $theCalendar = $( '#calendar' );

  var currentDate = $theCalendar.fullCalendar( 'getDate' );
  var fullCalendarDayContainers = $theCalendar.find( 'td[class*="fc-day"]' );

  for( var i = 0; i < fullCalendarDayContainers.length; i++ ) {

    var $currentContainer = $( fullCalendarDayContainers[ i ] );

    var dayNumber = $currentContainer.find( '.fc-day-number' ).html();

    // first find the matching day
    if ( eventDate.getDate() == dayNumber ) {

      // now month check, if our current container has fc-other-month
      // then the event month and the current month needs to mismatch,
      // otherwise container is missing fc-other-month then the event
      // month and current month need to match
      if( $currentContainer.hasClass( 'fc-other-month' ) ) {

        if( eventDate.getMonth() != currentDate.getMonth() ) {
          foundDay = $currentContainer;
          break;
        }
      }
      else {
        if ( eventDate.getMonth() == currentDate.getMonth() ) {
          foundDay = $currentContainer;
          break;
        }
      }
    }
  }

  return foundDay;
}

