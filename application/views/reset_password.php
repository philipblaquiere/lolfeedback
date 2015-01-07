<div class="container" >
	<
	<div class="row homepage-pitch-main-title brand ">
		LoL Feedback
	</div>
	<?php echo validation_errors(); ?>
	<div class="row login">
		<div class="col-sm-4 col-sm-offset-4">
			<?php echo form_open('', array('id' => 'reset-password-form')); ?>
			<div class="form-group">
				<span id="helpBlock" class="help-block ">If your email is registered with us, we'll send you an email with information required to reset your password.</span>
				<?php echo form_input(array('name' => 'password', 'id'=>'password', 'class' => 'form-control', 'placeholder' => 'New password' )); ?>
			</div>
			<div class="form-group">
				<?php echo form_input(array('name' => 'password2', 'id'=>'password2', 'class' => 'form-control', 'placeholder' => 'Confirm new password' )); ?>
			</div>
			<div class="form-group pull-right">
				<?php echo form_submit('submit', 'Reset Password', "class='btn btn-default forgot_password_btn pull-left'"); ?>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>