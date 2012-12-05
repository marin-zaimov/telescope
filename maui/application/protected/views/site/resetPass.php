<?php
$this->pageTitle=Yii::app()->name . ' - Reset Password';

?>

<style>
  #errorDiv {
    width: 400px;
    padding: 25px;
    border: 1px solid #CCC;
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    -ms-border-radius: 6px;
    border-radius: 6px;
    -webkit-box-shadow: 0 0 6px rgba(0,0,0,0.2);
    -moz-box-shadow: 0 0 6px rgba(0,0,0,0.2);
    -ms-box-shadow: 0 0 6px rgba(0,0,0,0.2);
    box-shadow: 0 0 6px rgba(0,0,0,0.2);
  }
  .formRow {
    margin-bottom: 10px;
  }
  .error {
    color: #B94A48;
  }
</style>
 
<? if (!empty($errors)): ?>
    <div id="errorDiv" class="alert-error">
      <? foreach ($errors as $e ): ?>
        <label class="text-error"><?= $e; ?></label>
      <? endforeach; ?>
    </div>
<? endif; ?>

<div class="login_box">

<form action="<?php echo Yii::app()->baseUrl; ?>/index.php/site/resetPassword" method="post" id="pw_reset_form">
	<h3 class="page-header">Reset Your Password</h3>
	<div class="cnt_b">
		<div class="formRow">
			<div class="input-prepend">
				<span class="add-on"><i class="icon-user"></i></span><input type="text" disabled value="<?= (isset($email) ? $email : ''); ?>" />
				<input type="hidden" id="username" name="User[email]" placeholder="Email" value="<?= (isset($email) ? $email : ''); ?>" />
			</div>
		</div>
		<div class="formRow">
			<div class="input-prepend">
				<span class="add-on"><i class="icon-lock"></i></span><input type="password" id="tempPassword" name="User[tempPassword]" placeholder="Temporary Password" />
			</div>
		</div>
		<div class="formRow">
			<div class="input-prepend">
				<span class="add-on"><i class="icon-lock"></i></span><input type="password" id="newPassword" name="User[newPassword]" placeholder="New Password" />
			</div>
		</div>
		<div class="formRow">
			<div class="input-prepend">
				<span class="add-on"><i class="icon-lock"></i></span><input type="password" id="confirmNewPassword" name="User[newPasswordConfirm]" placeholder="Confirm Password" />
			</div>
		</div>
	</div>
	<div class="btm_b clearfix">
		<button class="btn btn-primary" type="submit">Set password and login</button>
	</div>  
</form>
</div>

<script src="<?= Yii::app()->request->baseUrl; ?>/js/validation/jquery.validate.min.js"></script>
<script src="<?= Yii::app()->request->baseUrl; ?>/js/passwordHelper.js"></script>
<script src="<?= Yii::app()->request->baseUrl; ?>/js/resetPassword.js"></script>
