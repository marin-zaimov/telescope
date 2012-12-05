<?php 

/**
 * class ScheduleController
 * @package tcp.controllers
 */
class ScheduleController extends Controller
{

  public function actionSendReservationReminders()
  {
    $criteria = Reservations::model()->getDbCriteria();
    $params = array();
    $startTime =  date('Y-m-d', time()+86400).' 00:00:00'; //tomorrow
    $endTime =  date('Y-m-d', time()+172800).' 00:00:00'; //2 days from now
    
    $criteria->addCondition("startTime >= :startTime");
    $params[':startTime'] = $startTime;
    $criteria->addCondition("startTime <= :endTime");
    $params[':endTime'] = $endTime;

    $criteria->params = $params;
    $criteria->order = 'startTime';
    // query
    $reservations = Reservations::model()->findAll($criteria);
    
    foreach ($reservations as $r) {
      $user = $r->user;
      $startTime = strtotime($r->startTime);
      $emailHelper = new EmailHelper();
		  $params = array(
		    'NAME' => $user->firstName,
			  'STARTTIME' => date('m-d-Y H:i a', TimeHelper::toLocalTime($user->id, $startTime)),
			  'OBJECT' => $r->skyTime->type,
		  );
		  $template = 'reservationReminder';
		
		  $emailHelper->sendEmail($template, $params, $user->email);
    }
    die;
  }

  
  
  public function filters()
	{
		return array(
		    'accessControl',
		);
	}
	
  public function accessRules()
	{
		return array(
			array(
				'allow',
				'actions' => array(),
        'ips'=>array('127.0.0.1'),
			),
			array(
				'deny',
				'users' => array('?', '*')
			)
		);
	}
  
}
