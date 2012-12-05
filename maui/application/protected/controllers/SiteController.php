<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	
  public function actionResetPassword() {

		$userLoginInfo = $_POST['User'];

		$result = $this->resetPasswordAndLogin($userLoginInfo);

		if ($result->getStatus() == true) {
			$this->redirect(Yii::app()->baseUrl .'/index.php/site/index');
		}
		else {
			$data = array_merge($userLoginInfo, array('errors' => $result->getMessages()));
			$this->render('resetPass', $data);
		}
	}
	public function resetPassword($userLoginInfo)
	{
		$response = new AjaxResponse();
		if ($userLoginInfo->newPassword == $userLoginInfo->newPasswordConfirm) {
		  if (PasswordHelper::isValidPasswordPattern($userLoginInfo->newPassword)) {
			  try {
			
				  //hash temp Password. If the same
				  $user = Users::getByEmail($userLoginInfo->email);
				  if (empty($user->passwordResetTime) || empty($user->passwordReset) || (strtotime($user->passwordResetTime)) < time()) {
					  throw new Exception('Your temporary password has expired. Please request another if you have forgotten your permanent password.');
				  }
				  else if ($user->verifyPassword($userLoginInfo->tempPassword, true)) {
					  $user->salt = PasswordHelper::generateRandomSalt();
					  $user->password = PasswordHelper::hashPassword($userLoginInfo->newPassword, $user->salt);
					  $user->passwordReset = null;
					  $user->passwordResetTime = null;
					  if ($user->save()) {
				      $response->setStatus(true);
				      $response->addMessage("User password reset Successfully");
					  }
					  else {
					    $response->setStatus(false);
				      $response->addMessage('Something went wrong when trying to set a new password.');
					  }
				  } else {
				    $response->setStatus(false);
				    $response->addMessage('Incorrect temporary password.');
				  }
				
			  }
			  catch (Exception $ex) {
				  $response->setStatus(false);
				  $response->addMessage('Something went wrong when trying to set a new password.');
				  $response->addMessage($ex->getMessage());
			  }
		  } else {
		    $response->setStatus(false);
			  $response->addMessage("New Password is of invalid format. Password must:");
			  $response->addMessage("be from 9 to 31 characters in length");
			  $response->addMessage("contain at least one lower case letter");
			  $response->addMessage("contain at least one upper case letter");
			  $response->addMessage("contain at least one number:");
		  }
		}
		else {
			$response->setStatus(false);
			$response->addMessage("New Passwords are not the same");
		}
		
		return $response;
	}
	
  public function login($userLoginInfo)
	{
		$response = new AjaxResponse();
		if(!empty($userLoginInfo)) {
			$userLoginInfo = (object) $userLoginInfo;
			
			$userIdentity = new UserIdentity($userLoginInfo->email, $userLoginInfo->password);
			if($userIdentity->authenticate()) {
			  
			  //remove temp password if user logged in with regular password
			  $user = Users::getByEmail($userLoginInfo->email);
			  $user->passwordReset = null;
			  $user->passwordResetTime = null;
			  if ($user->save()) {
				  Yii::app()->user->login($userIdentity);
				  $response->setStatus(true);
				  $response->addMessage("User logged in Successfully");
			  }
			  else {
				  $response->setStatus(false);
				  $response->addMessage("User login failed");
			  }
			}
			else {
				$response->setStatus(false);
				$response->addMessage("User login failed");
			}
		}
		else {
			$response->setStatus(false);
			$response->addMessage("User login failed");
		}
		return $response;
	}
	
	public function resetPasswordAndLogin($userLoginInfo)
	{
		$response = new AjaxResponse();
		if(!empty($userLoginInfo)) {
			$userLoginInfo = (object) $userLoginInfo;
			try {
				$resetResult = $this->resetPassword($userLoginInfo);

				if ($resetResult->getStatus() == true) {
					$userLoginInfo->password = $userLoginInfo->newPassword;
					$loginResult = $this->login($userLoginInfo);
					if ($loginResult->getStatus() == true) {
						$response->setStatus(true);
						$response->addMessage("User password changed Successfully");
						$response->addMessage("User logged in Successfully");
					}
					else {
						return $loginResult;
					}
				}
				else {
					return $resetResult;
				}
			}
			catch (Exception $ex) {
				$response->setStatus(false);
				$response->addMessage('Something went wrong when trying to set a new password ans login.');
				$response->addMessage($ex->getMessage());
			}
		}
		else {
			$response->setStatus(false);
			$response->addMessage("No information entered.");
		}
		return $response;
	}


	public function actionRequestTempPassword()
	{
	  $response = new AjaxResponse();
		$userEmail = $_POST['email'];
		if ($userEmail != null) { 
			$user = Users::getByEmail($userEmail);

	    if (!empty($user)) {
	      if ($user->emailVerified == 'N') {
			    $response->setStatus(false);
			    $response->addMessage('Your email has not been verified. Click the link you received in your email after registration to verify it.');
		      echo $response->asJson();
		      return;
	      }
	    }
	    
			$result = Users::assignRandomPasswordToUser($userEmail);
      
			if ($result == true) {
				$randomPassword = $result->getData('randomPassword');
				$hashedRandonmPassword = $result->getData('hashedRandomPassword');
				$userName = $result->getData('userName');
			
				$emailHelper = new EmailHelper();
				$params = array(
				  'NAME' => $userName,
					'EMAIL' => $userEmail,
					'TEMP_PASSWORD' => $randomPassword,
					'LINK' => "<a href='http://".($_SERVER['SERVER_NAME'] . Yii::app()->request->baseUrl ."/index.php/site/passwordResetView?email=".urlencode($userEmail))."' target='_blank'>Click here to reset your password</a>"
				);

		    $template = 'requestTempPassword';
		
		    $emailHelper->sendEmail($template, $params, $userEmail);
        
			}
		}
		$response->setStatus(true);
		$response->addMessage("A temporary password had been emailed to you. Please follow the link in the email and use the emailed temporary password there to reset you password");
	  echo $response->asJson();
	}


	public function actionPasswordResetView()
	{
		$email = $_GET['email'];
    $newUser = $_GET['newUser'];
    $errors = array();
    
		$this->render('resetPass', array('email' => $email, 'errors' => $errors));
	}
	
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;
    
    if (Yii::app()->user->isGuest) {
		  // if it is ajax validation request
		  if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		  {
			  echo CActiveForm::validate($model);
			  Yii::app()->end();
		  }

		  // collect user input data
		  if(isset($_POST['LoginForm']))
		  {
			  $model->attributes=$_POST['LoginForm'];
			  // validate user input and redirect to the previous page if valid
			  if($model->validate() && $model->login())
				  $this->redirect(Yii::app()->user->returnUrl);
		  }
		  // display the login form
		  $this->render('login',array('model'=>$model));
		}
		else {
		  $this->redirect(Yii::app()->user->returnUrl);
		}
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
  public function actionAboutUs()
	{
		$this->render('aboutUs');
	}
	
	public function filters()
  {
    return array( 'accessControl' ); // perform access control for CRUD operations
  }

  public function accessRules()
  {
    return array(
      // marin zaimov 10/18/2012
      //commented out because all of the actions in this controller should be allowed for non logged in users
    
      /*array('allow', // allow authenticated users to access all actions
        'users'=>array('@'),
      ),
      array('allow',
        'actions'=>array('login'),
        'users'=>array('?'),
      ),
      array('deny'),
      */
    );
  }
}
