<?php

class MediaController extends Controller
{
	public function actionGetImage()
	{
		$this->render('getImage');
	}

	public function actionGetVideo()
	{
		$this->render('getVideo');
	}

	public function actionImageOfTheWeek()
	{
		$this->render('imageOfTheWeek');
	}

	public function actionIndex()
	{
		$this->render('index');
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
