<? $termsOfService = 'terms of service are defined here. This string is in protected/views/users/login form at the top.'; ?>


<h3>Create a New Account</h3>

<p>To create a new account enter your information below. You will recieve and email to confirm your account.</p>

<form class="user-form form-horizontal" name="input" action="ShowUserForm" method="post">
  
  <div class="control-group">
    <label class="control-label" for="inputEmail">Email</label>
    <div class="controls">
      <input type="text" name="User[email]" id="inputEmail" placeholder="Email">
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
      <input type="text" name="User[firstName]" id="inputFName" placeholder="First Name">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputLName">Last Name</label>
    <div class="controls">
      <input type="text" name="User[lastName]" id="inputLName" placeholder="Last Name">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputOrg">Organization</label>
    <div class="controls">
      <input type="text" name="User[organization]" id="inputOrg" placeholder="Organization">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputGMT">Time Zone</label>
    <div class="controls">
      <select name="User[GMToffset]" id="inputGMT" >
         <option value="0">GMT+0: London, England</option>
         <option value="1">GMT+1: Paris, France</option>
         <option value="2">GMT+2: Athens, Greece</option>
         <option value="3">GMT+3: Kuwait</option>
         <option value="4">GMT+4: Moscow, Russia</option>
         <option value="5">GMT+5</option>
         <option value="6">GMT+6</option>
         <option value="7">GMT+7</option>
         <option value="8">GMT+8: China Coast</option>
         <option value="9">GMT+9: Japan Standard</option>
         <option value="10">GMT+10: Guan Standard</option>
         <option value="11">GMT+11</option>
         <option value="12">GMT+12: International Date East Line</option>
         <option value="-1">GMT-1: West Africa</option>
         <option value="-2">GMT-2: Azores</option>
         <option value="-3">GMT-3: Buenos Aires</option>
         <option value="-4">GMT-4: Atlantic Standard</option>
         <option value="-5">GMT-5: Eastern Standard</option>
         <option value="-6">GMT-6: Central Standard</option>
         <option value="-7">GMT-7: Mountain Standard</option>
         <option value="-8">GMT-8: Pacific Standard</option>
         <option value="-9">GMT-9: Yukon Standard</option>
         <option value="-10">GMT-10: Alaska-Hawaii Standard</option>
         <option value="-11">GMT-11: Nome</option>
         <option value="-12">GMT-12: International Date Line West</option>
       </select>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label">Terms of Service</label>
    <div class="controls">
      <textarea class="input-xxlarge" readonly="readonly" rows="5"><? echo $termsOfService; ?></textarea><br/>
      <input type="checkbox" name="User[termsOfService]" id="inputTerms"><label for="inputTerms">I accept the Terms of Service</label>
    </div>
  </div>
  
  <input class="btn btn-primary" type="submit" value="Submit">
<form>

