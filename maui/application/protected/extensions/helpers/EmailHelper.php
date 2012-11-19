<?php

class EmailHelper
{
	private $templates = array(
		'resetPassword' => array(
			'subject' => 'Maui - Password Reset Request',
			'content' => 'You have requested a password change for a user with email %%EMAIL%%. <br/><br/> Here is your new temporary password: %%TEMP_PASSWORD%% <br/><br/> Please visit the link below and enter the correct email and temporary password to be able to set a new password. For security purposes, your temporary password WILL EXPIRE in 30 minutes. <br/> %%LINK%% <br/><br/> If you did not request a password change, please ignore this email.'
		),
		'newPassword' => array(
			'subject' => 'Maui - Your password has changed',
			'content' => 'The password has changed for a user with email %%EMAIL%%. <br/><br/>Please visit the link below to login with your new password. <br/> %%LINK%%'
		),
		'newUser' => array(
			'subject' => 'Maui - Your user acount has been created',
			'content' => 'A user account has been created for email %%EMAIL%%. <br/><br/>Your password: %%PWD%%<br/><br/>Please visit the link below to login with your new account. <br/> %%LINK%%'
		),
	);
	public function createTemplate($template, $params)
	{
		//Check to make sure the template exists
		if(!isset($this->templates[$template])) { return null; }

		//Fetch Template and replace variables
		$content = $this->templates[$template]["content"];
		foreach($params as $key=>$value) {
		    $content = str_replace('%%'.strtoupper($key).'%%', $value, $content);
		}

		$emailData = array('message' => $content, 'subject' => $this->templates[$template]["subject"]);
		return $emailData;
	}
	
	public function sendEmail($template, $params, $emailTo)
	{
		$messageData = $this->createTemplate($template, $params);
		$email = new Email();
		$email->to = $emailTo;
		$email->message = $messageData['message'];
		$email->subject = $messageData['subject'];
			
		$email->send();
	}

}




?>
