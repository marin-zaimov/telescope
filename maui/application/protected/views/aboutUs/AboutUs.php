<!DOCTYPE html>
<html>
<body>

<h1><p><b>About Us</b></p></h1>

<p>The Maui Telescope project is a collaboration of the Georgia Institute of Technology and the United States Air force. This project .</p>

<p>This is a paragraph about our sponsors.</p>

<p>This site was the Fall 2012 Senior Design project of Team Teamwork. Jasmine Lawrence served as Project Manager. Chris Porter, Marin Zaimov and Brad Vanslyke served as developers.</p>

<h1><p><b>Contact Us</b></p></h1>

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
