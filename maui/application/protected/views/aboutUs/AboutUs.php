<!DOCTYPE html>
<html>
<body>

<h1><p><b>About Us</b></p></h1>

<p>The Maui Telescope project is a collaboration of the Georgia Institute of Technology and the United States Air force. This project was started so that teachers around the world could use this telescope as a tool to teach their students.We hope that his site will be used by students and teacher around the world!</p>

<p>This is a paragraph about our sponsors.</p>
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/GeorgiaTech_logo.png" alt="saturn"width="100" height="80"> <p>          </p>
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/AirforceLogo.jpg" alt="saturn"width="100" height="80">


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
