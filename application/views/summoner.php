<?php if(empty($games)) { ?>
    <div class="row">
      <div class="col-md-4 col-md-offset-4"><span class="open_sans">No matches have been played</span></div>
    </div>
  <?php } else { ?>
  <div class="col-md-6 col-md-offset-3">
  <?php foreach ($games as $game) { ?>
    <?php for ($i=0; $i < count($game['100']); $i++) { ?>
      <div class="row ">
        <?php if(isset($game['100'][$i]['championSprite'])) { ?>
          <span class="pull-left">
            <img src="<?php echo $game['100'][$i]['championSprite'] ?>" class="img-responsive" alt="Responsive image">
          </span>
        <?php } ?>
        <span class="pull-left">
          <strong><?php echo $game['100'][$i]['name'] ?></strong>
        </span>
        <?php if(isset($game['200'][$i]['championSprite'])) { ?>
          <span class="pull-right">
            <img src="<?php echo $game['200'][$i]['championSprite'] ?>" class="img-responsive" alt="Responsive image">
          </span>
        <?php } ?>
        <span class="pull-right">
          <strong><?php echo $game['200'][$i]['name'] ?></strong>
        </span>
      </div>
    <?php } 
    } ?>
  </div>
  <?php } ?>


<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
    <h1> <?php echo $title ?></h1>
  </div>
  <div class="col-md-2"></div>
</div>
<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
    <h2> <?php echo $sub_title ?></h1>
  </div>
  <div class="col-md-2"></div>
</div>