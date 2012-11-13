<?php

class UserController extends Controller
{
	public function actionIndex()
	{
		$this->render('account');
	}

	public function actionProfile()
	{
	  $user = Yii::app()->user->model;
		$this->render('userForm', array('user' => $user));
	}
	
	public function actionShowUserForm()
	{
	  $user = new Users;
		$this->render('userForm', array('user' => $user));
	}
	
	public function actionSaveUser()
	{
	    $userData = $_POST['User'];

	    $response = new AjaxResponse;
		  
		  if (!($userData['password'] == $userData['cPassword'])) {
	      $response->setStatus(false, 'Make sure Password and Confirm Password fields are the same.');
	    }
	    
	    if (isset($userData['id'])) {
	      $user = Users::model()->findByPk($userData['id']);
	      if (!empty($userData['password'])) {
          if (PasswordHelper::isValidPasswordPattern($userData['password'])) {
			      $user->salt = PasswordHelper::generateRandomSalt();
			      $user->password = PasswordHelper::hashPassword($userData['password'], $user->salt);
		      }
		      else {
		        $response->setStatus(false, 'Password must contain at least one uppercase, one lowercase, one number, and be at least 9 characters long.');
		      }
	      }
			  unset($userData['password']);
			  $user->setFromArray($userData);
	    }
	    else {
	    
	      if ($userData['termsOfService'] == "on") {
	        $userData['termsOfService'] = 'Y';
	      }
	      else {
	        $userData['termsOfService'] = 'N';
	        $response->setStatus(false, 'You must accept the terms of service to register.');
	      }
	      
		    $user = Users::createFromArray($userData);

			  if (PasswordHelper::isValidPasswordPattern($userData['password'])) {
				  $user->salt = PasswordHelper::generateRandomSalt();
				  $user->password = PasswordHelper::hashPassword($userData['password'], $user->salt);
			  }
			  else {
			    $response->setStatus(false, 'Password must contain at least one uppercase, one lowercase, one number, and be at least 9 characters long.');
			  }
			}
			$messages = $response->getMessages();
			if (empty($messages)) {
		    if ($user->save()) {
		      $this->emailNewUser($user);
	        $response->setStatus(true, 'User saved successfully');
		    }
		    else {
	        $response->setStatus(false, $user->errors);
		    }
		  }
		  echo $response->asJson();
		  die;
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

  public function emailNewUser($user)
  {
    return true;
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
      array('allow',
        'actions'=>array('showUserForm','verifyEmail','saveUser'),
        'users'=>array('?'),
      ),
      array('deny'),
    );
  }
}
