<!DOCTYPE html>
<html>
<body>

<h1><p><b>My Account</b></p></h1>

<h3><p><b>My Reservations</b></p></h3>

<p>This is a list of my reservations dynamically pulled from the calendar!.
<br><br>
Saturn - Monday June, 2013 at 5:00pm EST</p>

<h3><p><b>My Photo's and Video's</b></p></h3>

<p>This is a gallery of all the awesome photo's and video's I took .</p>

<p><b>PHOTOS</b></p>
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/saturn.jpg" alt="saturn"width="200" height="128">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/sunrise.jpg" alt="sunrise"width="200" height="128">
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/Sun.png" alt="sun"width="200" height="128">

<br>
<br>
<br>
<p><b>VIDEOS</b></p>
<br>
<iframe width="640" height="360" src="http://www.youtube.com/embed/qa04iRjaBMA?feature=player_detailpage" frameborder="0" allowfullscreen></iframe>

</body>
</html>

