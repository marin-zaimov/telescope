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


  public function actionGetEvents()
  {
    
    $startTime = $_POST['startTime'];
    $endTime =$_POST['endTime'];

    //var_dump($startTime);
    //var_dump($endTime);

    $criteria = SkyTimes::model()->getDbCriteria();
    $criteria->addCondition('startTIme > '.$startTime);
    $criteria->addCondition('endTime < '.$endTime);

    //$criteria->addCondition('id' == 4863);


    $skytimes = SkyTimes::model()->find($criteria);
    
    //$event = SkyTimes::model()->findByPK(4863);
    //var_dump($event->attributes);
  
    //$names = array('john doe', 'jane doe');
    //$ids = array('123', '223');

    //$data['names'] = $names;
    //$data['ids'] = $ids;

    //var_dump($skytimes);
    //echo json_encode($data);
    //echo 'yo';
    echo json_encode($skytimes);

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
}
