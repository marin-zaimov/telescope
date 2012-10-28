<!DOCTYPE html>
<html>
<body>

<h1><p><b>About Us</b></p></h1>

<p>The Maui Telescope Project is a collaboration between the Georgia Institute of Technology and the United States Air force. This project was started so that educators around the world could use this telescope as a tool to teach their students about astronomy.We hope that his site will be used by students and teacher around the world!</p>
<br>
<p>This is a paragraph about our sponsors.</p>

<table border="0">

  <tr>
    <td><center><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/GeorgiaTech_logo.png" alt="saturn"width="200" height="180"></center></td>
    <td><center><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/AirforceLogo.jpg" alt="saturn"width="200" height="180"></center></td>
  </tr>

</table>




<br><br>
<p>This site was the Fall 2012 Senior Design project of Team Teamwork. Jasmine Lawrence served as Project Manager. Chris Porter, Marin Zaimov and Brad Vanslyke served as developers.</p>

<h1><p><b>Contact Us</b></p></h1>
<p>Please contact us if you have any questions, comments or concerns. Thanks!</p>
<form method="post" enctype="text/plain">
Name:<br>
<input type="text" name="name" value="your name"><br>
E-mail:<br>
<input type="text" name="mail" value="your email"><br>
Comment:<br>
<input type="text" name="comment" value="your comment" size="50"><br><br>
<input type="submit" value="Send">
<input type="reset" value="Reset">
</form>
</form>

</body>
</html>


<?php
if(isset($_POST['name']) && isset($_POST['mail']) && isset($_POST['comment'])){

$to = 'jasmine@gatech.edu';
$subject = 'Comments from TOM';
$message = $_POST['name'].$_POST['mail'].$_POST['comment'] ;
mail($to, $subject, $message); 
}


?>
