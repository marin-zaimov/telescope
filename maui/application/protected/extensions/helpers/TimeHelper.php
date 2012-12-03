<?php

class TimeHelper
{
	
	public function checkStartTimeIsBeforeEndTime($startTime, $endTime)
	{
		$startTime = strtotime($startTime);
		$endTime = strtotime($endTime);
		
		return $startTime < $endTime;
	}
	
	//public function localDatetimeToGMT($userId, $datetime)
  public function localDatetimeToGMT($userId, $datetime)
  {
    if (gettype($datetime) == 'integer') {
      $datetime = date('Y-m-d H:i:s', $datetime);
    }
		date_default_timezone_set('UTC');
		$timestamp = strtotime($datetime);
		$newTimestamp = self::toGMTTime($userId, $timestamp);
		return date('Y-m-d H:i:s', $newTimestamp);
	}
	
	public function toGMTTime($userId, $timestamp)
	{
		$user = Users::model()->findByPk($userId);
		//check if one hour before timestamp is in daylight savings. If so subtract an hour from timestamp
		$timstampMinusHour = $timestamp-3600;
		$timestampAfterDLChange = self::adjustTimeToDaylightSavings($user->GMToffset, $user->daylightSavings, $timstampMinusHour);
		if ($timestampAfterDLChange == $timestamp) {
			$timestamp -= 3600;
		}
		$timestamp -= 3600*$user->GMToffset;

    //var_dump($timestamp);
    //die;
		return $timestamp;
	}
	
	public function datetimeToLocal($userId, $datetime)
	{
		date_default_timezone_set('UTC');
		$timestamp = strtotime($datetime);
		$newTimestamp = self::toLocalTime($userId, $timestamp);
		return date('Y-m-d H:i:s', $newTimestamp);
	}
	
	public function toLocalTime($userId, $timestamp)
	{
		$user = Users::model()->findByPk($userId);
		
		$timestamp += 3600*$user->GMToffset;
		$timestamp = self::adjustTimeToDaylightSavings($user->GMToffset, $user->daylightSavings, $timestamp);
		return $timestamp;
	}
	
	public function adjustTimeToDaylightSavings($GMTOffset, $observeDST, $timestamp)
	{
		$timeZones = array( 
			'0' => 'UTC',
			'-5'=>'America/New_York', 
			'-6'=>'America/Chicago', 
			'-7'=>'America/Denver', 
			'-8'=>'America/Los_Angeles',
		);
		date_default_timezone_set($timeZones[$GMTOffset]);

		if (date('I', $timestamp) && $observeDST == 'Y') {
			$timestamp += 3600;
		}
		date_default_timezone_set('UTC');
		return $timestamp;
	}
	
	function timezoneExhibitsDST($tzId) {
		$tz = new DateTimeZone($tzId);
		$date = new DateTime("now",$tz);  
		$trans = $tz->getTransitions();
		foreach ($trans as $k => $t) 
		if ($t["ts"] > $date->format('U')) {
			return $trans[$k-1]['isdst'];    
		}
	}
	
}
