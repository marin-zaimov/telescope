<?php


  /*
    This script generates a file of mysql insert statements from a file called
    2012_Short.out.
    It makes the assumption that Sunrise, Sunset, and Stop are all events where
    the given starting time is also that its ending time.


    To generalize this script, the $f_in and $year variable should be handled.
    Furthermore, any other input files must have the same structure as 2012_Short.out.
    That is, months must be given with the first three letters (with the first letter
    capitalized.)  Days and their associated events should form a block, and each 
    block should be separated by a empty line with only the newline character.  Also,
    the day-by-day blocks should be similar in structure to those in 2012_Short.out, e.g.,
      Jan 1
      18 30 sunset
      19 00 moon
      ...
      6  04 sunrise


    helpful note:
    MySQL retrieves and displays DATETIME values in 'YYYY-MM-DD HH:MM:SS' format.

    example mysql insert statement:
    insert into skyTimes (startTIme, endTime, type) values('2012-01-01 17:00:00', '2012-01-01 18:00:00', 'Moon');
  */

  $f_in = "2012_Short.out"; // input filename
  $f_out = "skyTimes_inserts.sql"; //output filename
  $fh = fopen($f_out, 'w'); // file handler for fwrite and fclose functions

  
  $year = 2012; // all values in 2012_short.out are for the year 2012
  
  $second = "00"; // and granularity is only to the minute, so mysql can use 00 for seconds

  // all months in 2012_Short.out are given with the first three letters
  $months = array(
              "Jan" => "01",
              "Feb" => "02",
              "Mar" => "03",
              "Apr" => "04",
              "May" => "05",
              "Jun" => "06",
              "Jul" => "07",
              "Aug" => "08",
              "Sep" => "09",
              "Oct" => "10",
              "Nov" => "11",
              "Dec" => "12",
            );

  $start_hour   = NULL; // e.g. 00, 01, ..., 23
  $start_minute = NULL; // e.g. 00, 01, ..., 59
  $start_time   = NULL; // e.g. 2012-01-01 18:20:00
  $end_hour     = NULL; // e.g. 00, 01, ..., 23
  $end_minute   = NULL; // e.g. 00, 01, ..., 59
  $end_time     = NULL; // e.g. 2012-01-01 18:20:00
  $month        = NULL; // e.g. Jan, Feb, ..., Dec
  $day          = NULL; // e.g. 1, 2, ..., 31
  $sky_event    = NULL; // e.g. Sunset, Moon, Jupiter, etc.
  

  $just_saw_newline = true; // true if the last seen row of input was only a newline

  // proceed row by row on the input file
  //    php beginner tip: row's the key, data's the value
  //                      the => operator is making this associative array for us
  $txt_file    = file_get_contents($f_in);
  $rows        = explode("\n", $txt_file);
  foreach ($rows as $row => $data) {

    // because we split on newline characters,
    // the blank line separating each day are now
    // empty strings.
    // if we find such a row
    if (strlen($data) == 0) {

      // and we werent' just at a newline previously
      // (this avoids little bugs)
      if(!$just_saw_newline) {

        // then write the event to file.
        // this case only occurs for events where start_time and end_time match
        $start_time = $year ."-". $months[$month] ."-". $day ." ". $start_hour .":". $start_minute .":". $second;
        $to_write = "insert into skyTimes (startTIme, endTime, type) values('". $start_time ."', '". $start_time ."', '". $sky_event ."');\n";
        fwrite($fh, $to_write);
      }

      // set the start_hour to NULL so we know that we have no unwritten objects
      // (the purpose for this is clearer further in the script)
      $start_hour = NULL;
      $just_saw_newline = true; // and we just saw a newline, so set this to true
    }

    // else, we are looking at a row with either a day or its events
    else {

      // split the row on any number of white spaces
      // no flags, don't include empty strings
      $tokens = preg_split("/[\s]+/", $data, NULL, PREG_SPLIT_NO_EMPTY);

      // if we just saw the newline, then the next line holds the month and day,
      // so capture month and day
      if ($just_saw_newline) {
        $just_saw_newline = false;

        $month = $tokens[0];
        $day = $tokens[1];
        if ((0 + $day) < 10) // if integer value of day is less than 10
          $day = "0" . $day; // append a 0 to the front of the string, e.g. "6" -> "06"
      }

      // else, we're on a row with a sky_event and time,
      // so capture sky_event and time
      else {

        // the starting time for an event is the ending time for the previous one
        // capture these ending values
        $end_hour = $tokens[0];
        $end_minute = $tokens[1];

        // format
        if ((0 + $end_hour) < 10)
          $end_hour = "0" . $end_hour;
        if ((0 + $end_minute) < 10)
          $end_minute = "0" . $end_minute;

        // write the event to file using the end time above and start_time if we have one
        if ($start_hour != NULL) { 

          // format
          $start_time = $year ."-". $months[$month] ."-". $day ." ". $start_hour .":". $start_minute .":". $second;
          $end_time   = $year ."-". $months[$month] ."-". $day ." ". $end_hour   .":". $end_minute   .":". $second;

          // for sunrise, sunset, and stop, we use the same end time as start time
          if ($sky_event == "Sunrise" || $sky_event == "Sunset" || $sky_event == "Stop")
            $end_time = $start_time;

          // write to file
          $to_write = "insert into skyTimes (startTIme, endTime, type) values('". $start_time ."', '". $end_time ."', '". $sky_event ."');\n";
          fwrite($fh, $to_write);

        }

        // now capture the start time
        // the next iteration will find the end time and write to file
        $start_hour = $tokens[0];
        $start_minute = $tokens[1];
        
        // format
        if ((0 + $start_hour) < 10)
          $start_hour = "0" . $start_hour;
        if ((0 + $start_minute) < 10)
          $start_minute = "0" . $start_minute;

        // and lastly, capture the event to be written on the next iteration
        $sky_event = $tokens[2];
      }      

    }


  }

  // close output file
  fclose($fh);

?>
