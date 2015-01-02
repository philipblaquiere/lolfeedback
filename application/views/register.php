<!-- Header -->
<div class="page-header">
  <h1>Register</h1>
  <h4>This account will be used to login to our website</h4>
</div>
<!-- Header -->
          
<!-- Register Content -->
<?php echo validation_errors(); ?>
<?php echo form_open('register', array('class' => 'form-horizontal', 'id' => 'initial-registration')); ?>
  <div class="form-group">
    <?php echo form_label('Email', 'name', array('class' => 'col-sm-2 control-label')); ?>
    <div class="col-sm-4">
      <?php echo form_input(array('name' => 'email', 'class' => 'form-control', 'placeholder' => 'Email Address', 'id' => 'email')); ?>
    </div>
  </div>
  <div class="form-group">
    <?php echo form_label('Password', 'name', array('class' => 'col-sm-2 control-label')); ?>
    <div class="col-sm-4">
      <?php echo form_password(array('name' => 'password1', 'class' => 'form-control', 'placeholder' => 'Password', 'id' => 'password1')); ?>
    </div>
  </div>
  <div class="form-group">
    <?php echo form_label('Re-Enter Password', 'name', array('class' => 'col-sm-2 control-label')); ?>
    <div class="col-sm-4">
      <?php echo form_password(array('name' => 'password2', 'class' => 'form-control', 'placeholder' => 'Re-Enter Password', 'id' => 'password2')); ?>
    </div>
  </div>
  <div class="form-group">
    <div class="page-header"/>
  </div>
  <?php echo form_label('Summoner Name', 'summonername', array('class' => 'col-sm-2 control-label')); ?>
    <div class="col-sm-4">
      <div class="input-group">
        <div class="input-group-btn">
          <button type="button" class="btn btn-default dropdown-toggle" id="region" data-toggle="dropdown">Region <span class="caret"></span></button>
          <ul class="dropdown-menu region-list">
            <li><a href="#" selected>NA</a></li>
          </ul>
        </div><!-- /btn-group -->
        <?php echo form_input(array('name' => 'summonername','id' => 'summonername', 'class' => 'form-control', 'placeholder' => 'Summoner Name')); ?>
      </div><!-- /input-group -->
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-1 col-sm-offset-3">
      <?php echo form_submit('submit', 'Verify', "class='btn btn-default' id='original_registration_submit'"); ?>
    </div>
    <div class="col-sm-7" id="summoner_validation_error">
    </div>
  </div>
  <?php echo form_close(); ?>
<!-- Register Content -->


<div id="authenticate_runepage_page">
  <!-- Validation Content -->
</div>