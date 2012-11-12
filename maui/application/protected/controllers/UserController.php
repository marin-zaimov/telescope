<?php

class UserController extends Controller
{
	public function actionIndex()
	{
		$this->render('account');
	}

	public function actionProfile()
	{
		$this->render('profile');
	}
	
	public function actionShowUserForm()
	{
		if(isset($_POST['User'])){
	    $userData = $_POST['User'];
		  
		  if (!$userData['password'] == $userData['cPassword']) {
	      throw new Exception('Password and Confirm Password field are not the same.');
	    }
	    if ($userData['termsOfService'] == "on") {
	      $userData['termsOfService'] = 'Y';
	    }
	    else {
	      $userData['termsOfService'] = 'N';
	    }
		  $user = Users::createFromArray($userData);
		  if (!empty($userData['password'])) {
				if (PasswordHelper::isValidPasswordPattern($userData['password'])) {
					$user->salt = PasswordHelper::generateRandomSalt();
					$user->password = PasswordHelper::hashPassword($user->password, $user->salt);
				}
				else {
					throw new Exception('Password must contain at least one uppercase, one lowercase, one number, and be at least 9 characters long.');
				}
			}
			
		  if ($user->save()) {
		    $this->emailNewUser($user);
		    var_dump('Saved!');
		  }
		  else {
		    var_dump($user->errors);
		    var_dump('Not Saved');
		  }
		} else {
		  $this->render('loginForm');
		}
	}
	
	public function actionVerifyEmail()
	{
		if (isset($_GET['id']) and isset($_GET['email'])) {
	    
		  $user = Users::model()->findByPk($_GET['id']);
		  if ($user->email == $_GET['email']) {
		    $user->emailVerified = 'Y';
		    $model=new LoginForm;
		    $messages = array();
		    if ($user->save()) {
		      $messages[] = 'Thank you for veryfying your email';
		    }
		    else {
		      $model->addError('username','Your email verification failed.');
		    }
		    $this->render('/site/login',array('model'=>$model, 'messages' => $messages));
		  }
		  else {
		    throw new Exception('Invalid URL');
		  }
		} else {
		  throw new Exception('This link is not valid');
		}
	}


	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
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
      array('allow',
        'actions'=>array('showUserForm','verifyEmail'),
        'users'=>array('?'),
      ),
      array('deny'),
    );
  }
}
