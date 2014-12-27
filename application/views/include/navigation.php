  <!-- Static navbar -->
  <nav class="navbar navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="<?php echo site_url('home'); ?>">LetItOut</a>
      </div>
      <?php echo form_open('search', array('class' => 'navbar-form navbar-right', 'id' => 'search_summoner', 'role' => 'search')); ?>
        <div class="input-group">
            <?php echo form_input(array('name' => 'search', 'class' => 'form-control', 'placeholder' => 'Search Summoner', 'id' => 'search_textbox')); ?>
          <span class="input-group-btn">
            <button type="submit" class="btn btn-default">Search</button>
          </span>
        </div>
      <?php echo form_close(); ?>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <?php if ($is_logged_in): ?>
            <li class="dropdown">
              <a href="<?php echo site_url('summoner/') . $_SESSION['user']['id']?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['user']['name']; ?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo site_url('sign_in/sign_out'); ?>">Sign out</a></li>
                </ul>
            </li>
          <?php else: ?>
          <li><a href="<?php echo site_url('register'); ?>">Register</a></li>
            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign In<strong class="caret"></strong></a>
            <div class="dropdown-menu sign_in_mini">
              <?php echo form_open('sign_in', array('class' => 'form-horizontal', 'id' => 'signinform')); ?>
                <div class="form-group">
                  <div class="col-sm-12">
                    <?php echo form_input(array('name' => 'email', 'class' => 'form-control input-sm', 'placeholder' => 'Email' , 'size' => '30')); ?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <?php echo form_password(array('name' => 'password', 'class' => 'form-control input-sm', 'placeholder' => 'Password', 'size' => '30')); ?>
                  </div>
                </div>
                <a href="<?php echo site_url('sign_in/forgot_password'); ?>">Forgot Password?</a>
                <div class="form-group">
                  <div class="col-sm-5 pull-right">
                    <?php echo form_submit('submit', 'Sign In', "class='btn btn-default btn-sm pull-left'"); ?>
                  </div>
                </div>
              </li>
              <?php echo form_close(); ?>
            </div>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav><!-- Static nav -->