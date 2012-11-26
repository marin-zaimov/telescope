<?php $termsOfService = 'terms of service are defined here. This string is in protected/views/users/login form at the top.'; 
  $timezones =  array(
	"-12" => "(GMT -12:00) Eniwetok, Kwajalein",
	"-11" => "(GMT -11:00) Midway Island, Samoa",
	"-10" => "(GMT -10:00) Hawaii",
	"-9" => "(GMT -9:00) Alaska",
	"-8" => "(GMT -8:00) Pacific Time (US &amp; Canada)",
	"-7" => "(GMT -7:00) Mountain Time (US &amp; Canada)",
	"-6" => "(GMT -6:00) Central Time (US &amp; Canada), Mexico City",
	"-5" => "(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima",
	"-4" => "(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz",
	//"-3.5" => "(GMT -3:30) Newfoundland",
	"-3" => "(GMT -3:00) Brazil, Buenos Aires, Georgetown",
	"-2" => "(GMT -2:00) Mid-Atlantic",
	"-1" => "(GMT -1:00 hour) Azores, Cape Verde Islands",
	"0" => "(GMT) Western Europe Time, London, Lisbon, Casablanca",
	"1" => "(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris",
	"2" => "(GMT +2:00) Kaliningrad, South Africa",
	"3" => "(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg",
	//"3.5" => "(GMT +3:30) Tehran",
	"4" => "(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi",
	//"4.5" => "(GMT +4:30) Kabul",
	"5" => "(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent",
	//"5.5" => "(GMT +5:30) Bombay, Calcutta, Madras, New Delhi",
	"6" => "(GMT +6:00) Almaty, Dhaka, Colombo",
	"7" => "(GMT +7:00) Bangkok, Hanoi, Jakarta",
	"8" => "(GMT +8:00) Beijing, Perth, Singapore, Hong Kong",
	"9" => "(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk",
	//"9.5" => "(GMT +9:30) Adelaide, Darwin",
	"10" => "(GMT +10:00) Eastern Australia, Guam, Vladivostok",
	"11" => "(GMT +11:00) Magadan, Solomon Islands, New Caledonia",
	"12" => "(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka"
);
?>

<?php if ($user->isNewRecord): ?>
  <h3>Create a New Account</h3>
  <p>To create a new account enter your information below. You will recieve and email to confirm your account.</p>
<?php else: ?>
  <h3>Edit your profile</h3>
<?php endif; ?>



<form class="user-form form-horizontal" id="userForm" name="input" action="ShowUserForm" method="post">
  <?php if (!$user->isNewRecord): ?>
    <input type="hidden" id="userId" name="User[id]" value="<?php echo $user->id; ?>" />
  <?php endif; ?>
  <div class="control-group">
    <label class="control-label" for="inputEmail">Email</label>
    <div class="controls">
      <input type="text" name="User[email]" value="<?php echo $user->email; ?>" id="inputEmail" placeholder="Email">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPw">Password</label>
    <div class="controls">
      <input type="password" name="User[password]" id="inputPw" placeholder="Password"><br>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPwConfirm">Confirm Password</label>
    <div class="controls">
      <input type="password" name="User[cPassword]" id="inputPwConfirm" placeholder="Confirm Password">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputFName">First Name</label>
    <div class="controls">
      <input type="text" name="User[firstName]" value="<?php echo $user->firstName; ?>" id="inputFName" placeholder="First Name">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputLName">Last Name</label>
    <div class="controls">
      <input type="text" name="User[lastName]" value="<?php echo $user->lastName; ?>" id="inputLName" placeholder="Last Name">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputOrg">Organization</label>
    <div class="controls">
      <input type="text" name="User[organization]" value="<?php echo $user->organization; ?>" id="inputOrg" placeholder="Organization">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputGMT">Time Zone</label>
    <div class="controls">
      <select name="User[GMToffset]" id="inputGMT" >
        <?php foreach($timezones as $val => $label): ?>
        <option value="<?php echo $val; ?>" <?php echo (($val == $user->GMToffset) ? 'selected' : ''); ?> ><?php echo $label; ?></option>
        <?php endforeach; ?>
       </select>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputGMT">Daylight Savings</label>
    <div class="controls">
      <input type="checkbox" name="User[daylightSavings]" <?php echo (($user->daylightSavings == 'Y') ? 'checked' : ''); ?> id="inputDaylight"><label for="inputDaylight">I follow daylight savings</label>
    </div>
  </div>
  <?php if ($user->isNewRecord): ?>
  <div class="control-group">
    <label class="control-label">Terms of Service</label>
    <div class="controls">
      <textarea class="input-xxlarge" readonly="readonly" rows="5"><? echo $termsOfService; ?></textarea><br/>
      <input type="checkbox" name="User[termsOfService]" id="inputTerms"><label for="inputTerms">I accept the Terms of Service</label>
    </div>
  </div>
  <?php endif; ?>
  
  <input class="btn btn-primary" type="submit" value="Submit">
<form>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/userManager.js"></script>
