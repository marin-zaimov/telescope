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

  public function actionReserveEvent() {

    $reservationData = $_POST['reservation'];
    $response = new AjaxResponse;
    
    $reservation = Reservations::createFromArray($reservationData);
    $reservation->userId = Yii::app()->user->id;
    
    if ($reservation->save()) {
      $response->setStatus(true, 'Reservation saved successfully');
    }
    else {
      $response->setStatus(false, 'Reservation could not be saved');
    }
    
    echo $response->asJson();

  }


  // gets the events returns and returns the 
  public function actionGetEvents()
  {
    
    $userStartTime = $_POST['startTime'];
    $userEndTime =$_POST['endTime'];
    $userModel = Yii::app()->user->model;
    
    $serverStart = TimeHelper::localDatetimeToGMT($userModel->id, $userStartTime);
    $serverEnd = TimeHelper::localDatetimeToGMT($userModel->id, $userEndTime);

    $criteria = SkyTimes::model()->getDbCriteria();
    // build query
    $criteria->addCondition("startTime >= :startTime");
    $criteria->addCondition("endTime <= :endTime");
    $criteria->params = array(':startTime' => $serverStart, ':endTime' => $serverEnd);

    // query
    $skytimes = SkyTimes::model()->findAll($criteria);
    
    $reservation_times = array();
    if (!empty($skytimes)) {
      foreach ($skytimes as $s) {
      
        $start = strtotime($s->startTime);
        $end = strtotime($s->endTime);
        
        while ($start < $end) {
          $localStart = TimeHelper::toLocalTime($userModel->id, $start);
          $localEnd = TimeHelper::toLocalTime($userModel->id, ($start+1800));
          $reservation_times[] = (object) array(
            'event' => $s->type,
            'startTimeView' => date('h:i a', $localStart),
            'endTimeView' => date('h:i a', $localEnd),
            'startTime' => date('Y-m-d H:i:s', $start),
            'endTime' => date('Y-m-d H:i:s', ($start+1800)),
            'skyTimeId' => $s->id
          );
          $start = $start + 1800;
        }
      }
    }
    
    $this->renderPartial('showDay', array('reservation_times' => $reservation_times));
  }

  public function actionMyReservations() {

    $userModel = Yii::app()->user->model;
    
		date_default_timezone_set('UTC');
    $this->render('myReservations', array('reservations' => $userModel->reservations, 'userId' => Yii::app()->user->id));
  }
  
  public function actionRemoveMyReservation()
  {
    $id = $_POST['id'];
    $response = new AjaxResponse;
    $numDeleted = Reservations::model()->deleteByPk($id);
    if (!empty($numDeleted)) {
      $response->setStatus(true, 'Reservation deleted successfully');
    }
    else { 
      $response->setStatus(false, 'Failed to delete reservation.');
    }
    
    echo $response->asJson();
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


  // modifies a string with HH:MM format to datetime for a specific skyTime
  public function hourAndMinuteAndIdToDateTime($hhmm, $id) 
  {
    $skytime = SkyTimes::model()->findByPK($id);
    var_dump($skytime);
    die;
  } 


  // modifies a datetime to HH:MM string format
  public function dateTimeToHourAndMinute($a, $b) 
  {

  }



}
