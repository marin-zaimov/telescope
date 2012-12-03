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


  public function actionPopulateCalendar() {
    /*
    $reservations = Yii::app()->db->createCommand("SELECT * FROM reservations")->query();
    $skyTimes = Yii::app()->db->createCommand("SELECT * FROM skyTimes")->query();

    foreach ($reservations as $f)
      var_dump($f);
    foreach ($skyTimes as $f)
      var_dump($f);
    */

    $userModel = Yii::app()->user->model;
    $criteria = Reservations::model()->getDbCriteria();
    $params = array();
    if (isset($_GET['startTime'])) {
	    $userStartTime = $_GET['startTime'];
      $serverStart = TimeHelper::localDatetimeToGMT($userModel->id, $userStartTime);
      $criteria->addCondition("startTime >= :startTime");
      $params[':startTime'] = $serverStart;
    }
    if (isset($_GET['endTime'])) {
      $userEndTime = $_GET['endTime'];
      $serverEnd = TimeHelper::localDatetimeToGMT($userModel->id, $userEndTime);
      $criteria->addCondition("endTime <= :endTime");
      $params[':endTime'] = $serverEnd;
    }
    $criteria->params = $params;
    $criteria->order = 'startTime';
    // query
    $reservations = Reservations::model()->findAll($criteria);
    //$skyTimes = SkyTimes::model()->findAll($criteria);
    //var_dump($skyTimes);

    $data = array();
    foreach ($skyTimes as $st) {
      
      $start = strtotime($st->startTime);
      $end = strtotime($st->endTime);
      
      $localStart = TimeHelper::toLocalTime($userModel->id, $start);
      $localEnd = TimeHelper::toLocalTime($userModel->id, $end);
      
      $reserveCount = Yii::app()->db->createCommand("SELECT * FROM reservations WHERE skyTimeId=".$st->id)->query();

      var_dump($reserveCount);
      $data[] = array(
        //'title' => $st->type.': '.$st->user->organization .' - '.$r->user->firstName .' '.$r->user->lastName,
        //'start' => date('Y-m-d', $localStart),
      );
    }
    echo json_encode($data);



  }

  public function actionReserveEvent() {

    $reservationData = $_POST['reservation'];
    $response = new AjaxResponse;
    
    if (Reservations::existsForTime($reservationData['startTime'], $reservationData['endTime'])) {
      $response->setStatus(false, 'A Reservation already exists for this time');
    }
    else {
      $reservation = Reservations::createFromArray($reservationData);
      $reservation->userId = Yii::app()->user->id;
      
      if ($reservation->save()) {
        $response->addData('reservationId', $reservation->id);
        $response->setStatus(true, 'Reservation saved successfully');
      }
      else {
        $response->setStatus(false, 'Reservation could not be saved');
      }
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
          
          $reservations = Reservations::getByTime(date('Y-m-d H:i:s', $start), date('Y-m-d H:i:s', ($start+1800)));
          
          if (!empty($reservations)) {
            $reservation = $reservations[0];
            $bookedByUser = Users::model()->findByPk($reservation->userId);
          }
          else {
            $reservation = array();
            $bookedByUser = array();
          }
          $reservation_times[] = (object) array(
            'event' => $s->type,
            'startTimeView' => date('h:i a', $localStart),
            'endTimeView' => date('h:i a', $localEnd),
            'startTime' => date('Y-m-d H:i:s', $start),
            'endTime' => date('Y-m-d H:i:s', ($start+1800)),
            'skyTimeId' => $s->id,
            'reservation' => $reservation,
            'bookedByUser' => $bookedByUser
          );
          $start = $start + 1800;
        }
      }
    }
    
    $this->renderPartial('showDay', array('titleLabel' => date('F j', strtotime($userStartTime)),'reservation_times' => $reservation_times));
  }  
  
	public function actionAllReservations()
	{

    $userModel = Yii::app()->user->model;
    $criteria = Reservations::model()->getDbCriteria();
    $params = array();

    if (isset($_GET['startTime'])) {
	    $userStartTime = intval($_GET['startTime']);
      $serverStart = TimeHelper::localDatetimeToGMT($userModel->id, $userStartTime);
      $criteria->addCondition("startTime >= :startTime");
      $params[':startTime'] = $serverStart;
    }


    if (isset($_GET['endTime'])) {
      $userEndTime = intval($_GET['endTime']);
      $serverEnd = TimeHelper::localDatetimeToGMT($userModel->id, $userEndTime);
      $criteria->addCondition("endTime <= :endTime");
      $params[':endTime'] = $serverEnd;
    }
    $criteria->params = $params;
    $criteria->order = 'startTime';
    // query
    $reservations = Reservations::model()->findAll($criteria);

    $data = array();
    foreach ($reservations as $r) {
      
      $start = strtotime($r->startTime);
      $end = strtotime($r->endTime);
      
      $localStart = TimeHelper::toLocalTime($userModel->id, $start);
      $localEnd = TimeHelper::toLocalTime($userModel->id, $end);
      
      $data[] = array(
        'title' => $r->skyTime->type.' - '.$r->user->organization .' - '.$r->user->firstName .' '.$r->user->lastName,
        'start' => date('Y-m-d', $localStart),
        'end' => date('Y-m-d', $localEnd),
        'description' => date('h:i a', $localStart),
      );
    }
    echo json_encode($data);
    
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
