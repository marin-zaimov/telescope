<?php

class UserController extends Controller
{
	public function actionIndex()
	{
		//$this->render('account');
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
		  try 
		  {
			  if ($userData['daylightSavings'] == "on") {
          $userData['daylightSavings'] = 'Y';
        }
        else {
          $userData['daylightSavings'] = 'N';
        }
	      
	      //check passwords are the same
		    if (!($userData['password'] == $userData['cPassword'])) {
	        $response->setStatus(false, 'Make sure Password and Confirm Password fields are the same.');
	      }
	      
	      
        //check .edu and .k12.ga.us address
        $emailExplode = explode('.', $userData['email']);
        $last = array_pop($emailExplode);
        $secondLast = array_pop($emailExplode);
        $thirdLast = array_pop($emailExplode);
        if ($last != 'edu' && !($last == 'us' && $secondLast == 'ga' && $thirdLast == 'k12')) {
          $response->setStatus(false, 'You must have a ".edu" or ".k12.ga.us" email address to register.');
        }
        
	      //if existing user
	      if (isset($userData['id'])) {
	        $user = Users::model()->findByPk($userData['id']);
	        if (!empty($userData['password'])) {
            if (PasswordHelper::isValidPasswordPattern($userData['password'])) {
			        $user->salt = PasswordHelper::generateRandomSalt();
			        $user->password = PasswordHelper::hashPassword($userData['password'], $user->salt);
		          $emailTemplate = 'newPassword';
		        }
		        else {
		          $response->setStatus(false, 'Password must contain at least one uppercase, one lowercase, one number, and be at least 9 characters long.');
		        }
	        }
			    unset($userData['password']);
			    $user->setFromArray($userData);
	      }
	      //if new user
	      else {
	        //check terms of service
	        if ($userData['termsOfService'] == "on") {
	          $userData['termsOfService'] = 'Y';
	        }
	        else {
	          $userData['termsOfService'] = 'N';
	          $response->setStatus(false, 'You must accept the terms of service to register.');
	        }
	        
	        
		      $user = Users::createFromArray($userData);
          $emailTemplate = 'newUser';
          
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
		        if (isset($emailTemplate)) {
				      $this->emailNewPasswordToUser($user, $emailTemplate);
				      $this->emailAdminOfNewUser($user);
				    }
	          $response->setStatus(true, 'User saved successfully');
		      }
		      else {
	          $response->setStatus(false, $user->errors);
		      }
		    }
		  }
		  catch (Exception $ex) {
			  $response->setStatus(false, 'User could not be saved.');
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
		      $this->emailVerifiedUser($user);
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
	
	private function emailVerifiedUser($user)
	{
	  $emailHelper = new EmailHelper();
		$params = array(
			'NAME' => $user->firstName
		);
		$template = 'verifiedUser';
		
		$emailHelper->sendEmail($template, $params, $user->email);
	}

  private function emailNewPasswordToUser($user, $template)
	{
		$emailHelper = new EmailHelper();
		$params = array(
			'EMAIL' => $user->email,
			'LINK' => "<a href='http://".($_SERVER['SERVER_NAME'] . Yii::app()->request->baseUrl ."/index.php/site/login") . 
        "' target='_blank'>Click here to go to the login page</a>"
		);
		if ($template == 'newUser') {
		  $params['LINK'] = "<a href='http://".($_SERVER['SERVER_NAME'] . Yii::app()->request->baseUrl ."/index.php/user/verifyEmail?email=".urlencode($user->email))."&id=".$user->id."' target='_blank'>Click here to verify your email</a>";
		}
		$emailHelper->sendEmail($template, $params, $user->email);
	}
	
	private function emailAdminOfNewUser($user)
	{
	  $emailHelper = new EmailHelper();
		$params = array(
			'EMAIL' => $user->email,
			'NAME' => $user->firstName .' '.$user->lastName,
			'ORGANIZATION' => $user->organization,
			'SCHOOLNAME' => $user->schoolName,
			'SCHOOLLOCATION' => $user->schoolLocation,
			
		);
		$template = 'adminUserCreated';

		$emailHelper->sendEmail($template, $params, Yii::app()->params['adminEmail']);
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
