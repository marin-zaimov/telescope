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
	
	public function authenticate()
	{
    if (($this->username == 'admin' && $this->password == 'admin') || ($this->username == 'demo' && $this->password == 'demo')) {
      $this->errorCode=self::ERROR_NONE;
      return !$this->errorCode;
    }

		$this->_userData = Users::model()->findByAttributes(array('email' => $this->username));
		if (empty($this->_userData)) {
		$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		else if($this->_userData->verifyPassword($this->password)) {
			$this->errorCode=self::ERROR_NONE;
			$this->setupIdentity();
		}
		else {
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		}

		return !$this->errorCode;
	}
	
	private function setupIdentity()
	{
		$this->_id = $this->_userData->id;
		$this->setState('email', $this->_userData->email);
		$this->setState('id', $this->_userData->id);
		$this->setState('firstName', $this->_userData->firstName);
		$this->setState('lastName', $this->_userData->lastName);
		//$this->setState('fullName', $this->_userData->firstName . ' ' . $this->_userData->lastName);

		
	}
	
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	/*public function authenticate()
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
	}*/
}
