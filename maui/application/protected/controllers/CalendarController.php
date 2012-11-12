<?php

class CalendarController extends MauiController
{



	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionReserve()
	{
		$this->render('reserve');
	}

	public function actionShowDay()
	{
		$this->render('showDay');
	}
	
	public function actionPopulateDB()
	{
	    var_dump('hahaha');
	}


  // gets the events returns and returns the 
  public function actionGetEvents()
  {
    
    $startTime = $_POST['startTime'];
    $endTime =$_POST['endTime'];


    $criteria = SkyTimes::model()->getDbCriteria();

    // NOT SAFE:
    //$criteria->addCondition("startTime > '".$startTime."'");
    //$criteria->addCondition("endTime < '".$endTime."'");

    // build query
    $criteria->addCondition("startTime >= :startTime");
    $criteria->addCondition("endTime <= :endTime");
    $criteria->params = array(':startTime' => $startTime, ':endTime' => $endTime);

    // query
    $skytimes = SkyTimes::model()->findAll($criteria);

    // tailor it for our needs
    $temp_skytimes = array();
    if (!empty($skytimes)) {

      // fix it so json_encode works
      foreach ($skytimes as $s) {
         $temp_skytimes[] = $s->attributes; // append to result
      }

      // order by evening and morning times
      $evening = array();
      $morning = array();
      foreach ($temp_skytimes as $ts) {
        if (intval(substr($ts['startTime'],11,2)) >= 12)
          $evening[] = $ts;
        else
          $morning[] = $ts;
      }

      // sort the evening and morning times separately
      usort($evening, array($this,"sortBystartTime"));
      usort($morning, array($this,"sortBystartTime"));

      // combine them, with evening first, then morning
      $result_skytimes = array_merge($evening, $morning);


      //TODO query reservation table to see what's been booked

      // create the 30-minute interval reservation times
      // ... dont ask
      $reservation_times = array();
      foreach ($result_skytimes as $rs) {

        $start = substr($rs['startTime'],11,5);
        $end = substr($rs['endTime'],11,5);

        $half_hour = intval(substr($start, 3, 2));
        //$xx = 0;
        while ($start != $end) {
          //var_dump($start);
          $interval_begin = $start;

          $half_hour += 30;
          if ($half_hour % 60 == 0)
            $start = (intval(substr($start, 0, 2))+1) . ':00';
          else
            $start = substr($start, 0, 2) . ':30';
          $next_day = intval(substr($start, 0, 2)) % 24;
          if ($next_day < 10) {
            if (strlen($start) == 5)
              $start = '0' . $next_day . substr($start, 2, 3);
            else
              $start = '0' . $next_day .':'. substr($start, 2, 3);
          }

          $interval_end = $start;


          // append to our reservation list
          $reservation_times[] = array('event' => $rs['type'], 'startTime' => $interval_begin, 'endTime' => $interval_end);

        }


      }

      //var_dump($reservation_times);
      //die;

    }
    //TODO strip out id and crap from result_skytimes.... do we even need it?
    // just a simple summary for the user at the top is what we want.
    //$to_client = json_encode(array('reservation_times' => $reservation_times, 'skytimes' => $result_skytimes)); 
    //echo $to_client;
    echo json_encode(array('reservation_times' => $reservation_times, 'skytimes' => $result_skytimes)); 

  }



	public function filters()
  {
    return array( 'accessControl' ); // perform access control for CRUD operations
  }

  public function accessRules()
  {
    return array(
      array('allow', // allow authenticated users to access all actions
        'users'=>array('@'),
      ),
      /*array('allow',
        'actions'=>array('index'),
        'users'=>array('?'),
      ),*/
      array('deny'),
    );
  }

  // sort a set of evening or morning times by start time, earliest first
  public function sortBystartTime($a, $b)
  {
    $a_time = intval(substr($a['startTime'],11,2)
                  . (substr($a['startTime'],14,2))
                  . (substr($a['startTime'],17,2)));
    $b_time = intval(substr($b['startTime'],11,2)
                  . (substr($b['startTime'],14,2))
                  . (substr($b['startTime'],17,2)));

    if ($a_time < $b_time)
      return -1;
    else if ($a_time > $b_time)
      return 1;
    else
      return 0;
  }

}
