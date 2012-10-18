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
