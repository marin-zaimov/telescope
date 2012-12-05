<?php

class EmailHelper
{
	private $templates = array(
		'resetPassword' => array(
			'subject' => 'Maui Telescope - Password Reset Request',
			'content' => 'You have requested a password change for a user with email %%EMAIL%%. <br/><br/> Here is your new temporary password: %%TEMP_PASSWORD%% <br/><br/> Please visit the link below and enter the correct email and temporary password to be able to set a new password. For security purposes, your temporary password WILL EXPIRE in 30 minutes. <br/> %%LINK%% <br/><br/> If you did not request a password change, please ignore this email.'
		),
		'newPassword' => array(
			'subject' => 'Maui Telescope - Your password has changed',
			'content' => 'The password has changed for a user with email %%EMAIL%%. <br/><br/>Please visit the link below to login with your new password. <br/> %%LINK%%'
		),
		'newUser' => array(
			'subject' => 'Maui Telescope - Your user acount has been created',
			'content' => 'A user account has been created for email %%EMAIL%%.<br/><br/>Please click the link below to verify this email and login with your new account. <br/> %%LINK%%'
		),
		'verifiedUser' => array(
			'subject' => 'Maui Telescope - Welcome! Your account has been verified',
			'content' => 'Hey %%NAME%%,<br/></br>Welcome to the Telescope on Maui project.<br/></br>Thanks for registering.'
		),
		'requestTempPassword' => array(
			'subject' => 'Maui Telescope - You have requested a temporary password',
			'content' => 'Hey %%NAME%%,<br/></br>You have requested a temporary password.<br/></br>Here is your temporary password: %%TEMP_PASSWORD%%<br/><br/>Please click on the link below to reset your password.<br/><br/> %%LINK%%'
		),
		'adminUserCreated' => array(
			'subject' => 'Maui Telescope - A new user has registered',
			'content' => 'A new user has registered. Below are the user details:<br/></br>Email: %%EMAIL%%<br/>Name: %%NAME%%<br/>Organization: %%ORGANIZATION%%<br/>School name: %%SCHOOLNAME%%<br/>School Location: %%SCHOOLLOCATION%%'
		),
		'reservationReminder' => array(
			'subject' => 'Maui Telescope - Your reservation is approaching',
			'content' => 'Hey %%NAME%%,<br/></br>This is just a reminder that your reservation to use the telescope is approaching.<br/><br/>It is scheduled for %%STARTTIME%%.<br/><br/>You will be viewing: %%OBJECT%%.<br/><br/>Enjoy the rest of your day!<br/><br/>-The Telescope on Maui Project'
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
	  //params set in config/main.php
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	  $headers .= 'From: '.Yii::app()->params['adminEmail'] . "\r\n" .
    $headers .= 'Reply-To: webmaster@example.com' . "\r\n";
 
    // Additional headers
    //$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
    //$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
    
    
		$messageData = $this->createTemplate($template, $params);
		var_dump($messageData);
		mail($emailTo, $messageData['subject'], $messageData['message'], $headers);
		//die;
		//var_dump($emailTo);
		//var_dump($messageData);
		//var_dump($headers);
		//die;
		/*$email = new Email();
		$email->to = $emailTo;
		$email->message = $messageData['message'];
		$email->subject = $messageData['subject'];
			
		$email->send();*/
	}

}




?>
