<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
  
  private $_id = null;
	private $_roles = array();
	private $_userData = null;
	private $_auth = null;
	//private $_privileges = array();
	//private $_access = array();
	
	/*public function authenticate()
	{
		//$this->_auth = Yii::app()->authManager;

		try {
      //$this->_userData = Users::model()->findByAttributes(array('email'=>'marin@gatech.edu'));
			$this->_userData = Users::model()->findByAttributes(array('email' => $this->username));
			//throw new Exception($this->userData->email);
			if($this->_userData->verifyPassword($this->password)) {
				$this->errorCode=self::ERROR_NONE;
			}
			else {
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
			}

		}
		catch (Exception $ex) {
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}

		return !$this->errorCode;
	}
	
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}
}
