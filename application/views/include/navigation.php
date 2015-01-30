  <!-- Static navbar -->

  <nav class="navbar navbar-fixed-top lights" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand site-header brand" href="<?php echo site_url('home'); ?>">LoL Fe<span class="navclip"><span class="half"><i class="fa fa-volume-up"></i></span></span>dback</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <?php if ($is_logged_in): ?>
            <li class="dropdown">
              <a class="btn btn-link" href="<?php echo site_url('summoner') . "/" . $_SESSION['user']['id']?>"><?php echo $_SESSION['user']['name']; ?></a>
            </li>
            <li>   
              <a class="btn btn-link dropdown-toggle" data-toggle="dropdown" href="#"><span class="fa fa-caret-down"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo site_url('auth/sign_out'); ?>">Sign out</a></li>
              </ul>
            </li>
          <?php else: ?>
            <li><a href="<?php echo site_url('register'); ?>">Register</a></li>
            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign In<strong class="caret"></strong></a>
              <div class="dropdown-menu sign_in_mini">
                <div class="row login ">
                  <div class="col-sm-12">
                    <?php echo form_open('auth/sign_in', array('id' => 'signinform')); ?>
                    <div class="form-group">
                      <?php echo form_input(array('name' => 'email', 'class' => 'form-control', 'placeholder' => 'Email' )); ?>
                    </div>
                    <div class="form-group">
                      <?php echo form_password(array('name' => 'password', 'class' => 'form-control', 'placeholder' => 'Password')); ?>
                    </div>
                    <a href="<?php echo site_url('auth/forgot'); ?>">Forgot Password?</a>
                    <div class="form-group pull-right">
                      <?php echo form_submit('submit', 'Sign In', "class='btn btn-default btn-sm pull-left'"); ?>
                    </div>
                    <?php echo form_close(); ?>
                  </div>
                </div>
              </div>
            <?php endif; ?>
            <li>
              <?php echo form_open('search', array('class' => 'navbar-form navbar-right', 'id' => 'search_summoner', 'role' => 'search')); ?>
              <div class="input-group search">
                <?php echo form_input(array('name' => 'search', 'class' => 'form-control', 'placeholder' => 'Summoner Name', 'id' => 'search_textbox')); ?>
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-default">Search</button>
                </span>
              </div>
              <?php echo form_close(); ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Static nav -->
    <div class="wrapper">
  <!-- Wrapper -->