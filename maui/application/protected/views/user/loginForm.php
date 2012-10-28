<h1>Create a New Account</h1>
<p>To create a new account enter your information below. You will recieve and email to confirm your account.</p>
<form name="input" action="ShowUserForm" method="get">
Email: <input type="text" name="User[email]"><br>
Password: <input type="password" name="User[password]"><br>
Confirm Password: <input type="password" name="User[cPassword]"><br>
First name: <input type="text" name="User[firstName]"><br>
Last name: <input type="text" name="User[lastName]"><br>
Organization: <input type="text" name="User[organization]"><br>
GMT: <select name= "User[GMToffset]">
       <option value="GMT+0">GMT+0:London, England</option>
       <option value="GMT+1">GMT+1:Paris, France</option>
       <option value="GMT+2">GMT+2:Athens, Greece</option>
       <option value="GMT+3">GMT+3:Kuwait</option>
       <option value="GMT+4">GMT+4:Moscow, Russia</option>        <option value="GMT+5">GMT+5</option>
       <option value="GMT+6">GMT+6</option>
       <option value="GMT+7">GMT+7</option>
       <option value="GMT+8">GMT+8:China Coast</option>
       <option value="GMT+9">GMT+9:Japan Standard</option>
       <option value="GMT+10">GMT+10:Guan Standard</option>
       <option value="GMT+11">GMT+11</option>
       <option value="GMT+12">GMT+12:International Date East Line</option>
       <option value="GMT-1">GMT-1:West Africa</option>
       <option value="GMT-2">GMT-2:Azores</option>
       <option value="GMT-3">GMT-3:Buenos Aires</option>
       <option value="GMT-4">GMT-4:Atlantic Standard</option>
       <option value="GMT-5">GMT-5:Eastern Standard</option>
       <option value="GMT-6">GMT-6:Central Standard</option>
       <option value="GMT-7">GMT-7:Mountain Standard</option>
       <option value="GMT-8">GMT-8:Pacific Standard</option>
       <option value="GMT-9">GMT-9:Yukon Standard</option>
       <option value="GMT-10">GMT-10:Alaska-Hawaii Standard</option>
       <option value="GMT-11">GMT-11: Nome</option>
       <option value="GMT-12">GMT-12:International Date Line West</option>
       
       
</select><br>
<input type="submit" value="Submit">
<form>

