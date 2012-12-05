
<style>
  #forgotPassword {
    font-size: 75%;
  }
</style>

<?php
$this->pageTitle=Yii::app()->name . ' - Login';
?>

<h3 class="page-header">Login</h3>

<?php if (isset($messages)): ?>
  <?php foreach($messages as $m): ?>
    <h4><?php echo $m; ?> </h4>
  <?php endforeach; ?>
<?php endif; ?>

  
<p>Please fill out the following form with your login credentials:</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'action' => array('site/login')
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		<br/><a href="#" id="forgotPassword">Forgot Password?</a>
	</div>
<br/>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Login', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

If you dont have an account, <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/showUserForm">click here to register</a>


<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/loginManager.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/sticky.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/MauiBase.js"></script>


