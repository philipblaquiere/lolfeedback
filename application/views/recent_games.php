<div class="row">
  <div class="col-md-7">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
      <?php foreach ($games as $gameid => $game) { ?>
      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="<?php echo $gameid ?>-heading">
          <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $gameid ?>" aria-expanded="true" aria-controls="<?php echo $gameid ?>">
            Game played on <?php echo $game['time'] ?> GMT
          </a>
        </div>
        <div id="<?php echo $gameid ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="<?php echo $gameid ?>-heading">
          <div class="panel-body">
            <?php for ($i=0; $i < count($game['100']); $i++) { ?>
            <div class="feedback-row row">
              <div class="col-md-1">
                <div class="summoner-icon">
                  <?php if(isset($game['100'][$i]['championSprite'])) { ?>
                  <img src="<?php echo $game['100'][$i]['championSprite'] ?>" class="lol-match-icon" alt="Responsive image">
                  <?php } ?>
                </div>
              </div>
              <div class="col-md-2">
                <div class="summoner-name">
                  <a href="<?php echo site_url('summoner') . "/" . $game['100'][$i]['summonerId']; ?>" class="btn btn-link"><?php echo $game['100'][$i]['name'] ?></a>           
                </div>
              </div>
              <div class="col-md-5">
                <?php if(array_key_exists($_SESSION['user']['id'] . "-" . $game['100'][$i]['summonerId'] . "-" . $gameid, $current)) { ?>
                <?php } else if($_SESSION['user']['id'] != $game['100'][$i]['summonerId']) { ?>
                <div class="summoner-feedback-button" id="<?php echo $_SESSION['user']['id'] . "-" . $game['100'][$i]['summonerId'] . "-" . $gameid?>">
                  <button type="button" id="<?php echo $_SESSION['user']['id'] . "-" . $game['100'][$i]['summonerId'] . "-" . $gameid?>" class="btn btn-link review" name="review_summoner">feedback</button>
                </div>
                <?php } ?>
              </div>
              <div class="col-md-4">
                <div class="summoner-feedback-comment" id="<?php echo $_SESSION['user']['id'] . "-" . $game['100'][$i]['summonerId'] . "-" . $gameid ?>-message">
                </div>
              </div>
            </div>
            <?php } ?>
            <div class="space"></div>
            <?php for ($i=0; $i < count($game['200']); $i++) { ?>
            <div class="feedback-row row">
              <div class="col-md-1">
                <div class="summoner-icon">
                  <?php if(isset($game['200'][$i]['championSprite'])) { ?>
                  <img src="<?php echo $game['200'][$i]['championSprite'] ?>" class="lol-match-icon" alt="Responsive image">
                  <?php } ?>
                </div>
              </div>
              <div class="col-md-2">
                <div class="summoner-name">
                  <a href="<?php echo site_url('summoner') . "/" . $game['200'][$i]['summonerId']; ?>" class="btn btn-link"><?php echo $game['200'][$i]['name'] ?></a>           
                </div>
              </div>
              <div class="col-md-5">
                <?php if(array_key_exists($_SESSION['user']['id'] . "-" . $game['200'][$i]['summonerId'] . "-" . $gameid, $current)) { ?>
                <?php } else if($_SESSION['user']['id'] != $game['200'][$i]['summonerId']) { ?>
                <div class="summoner-feedback-button" id="<?php echo $_SESSION['user']['id'] . "-" . $game['200'][$i]['summonerId'] . "-" . $gameid?>">
                  <button type="button" id="<?php echo $_SESSION['user']['id'] . "-" . $game['200'][$i]['summonerId'] . "-" . $gameid?>" class="btn btn-link review" name="review_summoner">feedback</button>
                </div>
                <?php } ?>
              </div>
              <div class="col-md-4">
                <div class="summoner-feedback-comment" id="<?php echo $_SESSION['user']['id'] . "-" . $game['200'][$i]['summonerId'] . "-" . $gameid ?>-message">
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>