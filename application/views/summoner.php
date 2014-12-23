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

<?php if(empty($games)) { ?>
    <div class="row">
      <div class="col-md-4 col-md-offset-4"><span class="open_sans">No matches have been played</span></div>
    </div>
  <?php } else { ?>
  <div class="col-md-8 col-md-offset-2">
  <?php foreach ($games as $gameid => $game) { ?>

    <table class="table table-condensed">
    <?php for ($i=0; $i < count($game['100']); $i++) { ?>
    <tr>
      <td>
        <?php if(isset($game['100'][$i]['championSprite'])) { ?>
          <span class="pull-left">
            <img src="<?php echo $game['100'][$i]['championSprite'] ?>" class="img-responsive lol-match-icon" alt="Responsive image">
          </span>
        <?php } ?>
      </td>
      <td>
        <span >
          <a href="<?php echo site_url('summoner') . "/" . $game['100'][$i]['summonerId']; ?>"><?php echo $game['100'][$i]['name'] ?></a>
        </span>
      </td>
      <td>
      <?php if(array_key_exists($_SESSION['user']['id'] . "-" . $game['100'][$i]['summonerId'] . "-" . $gameid, $current)) { ?>
       <?php } else if($_SESSION['user']['id'] != $game['100'][$i]['summonerId']) { ?>
        <div id="<?php echo $_SESSION['user']['id'] . "-" . $game['100'][$i]['summonerId'] . "-" . $gameid?>">
          <button type="button" id="<?php echo $_SESSION['user']['id'] . "-" . $game['100'][$i]['summonerId'] . "-" . $gameid?>" class="btn btn-link review" name="review_summoner">review</button>
        </div>
      <?php } ?>
      </td>
    </tr>
    <?php } ?>
    </table>

    <table class="table table-condensed">
    <?php for ($i=0; $i < count($game['200']); $i++) { ?>
     <tr>
      <td>
        <?php if(isset($game['200'][$i]['championSprite'])) { ?>
          <span class="pull-left">
            <img src="<?php echo $game['200'][$i]['championSprite'] ?>" class="img-responsive lol-match-icon" alt="Responsive image">
          </span>
        <?php } ?>
      </td>
      <td>
        <span >
          <a href="<?php echo site_url('summoner') . "/" . $game['200'][$i]['summonerId']; ?>"><?php echo $game['200'][$i]['name'] ?></a>
        </span>
      </td>
      <td>
      <?php if($_SESSION['user']['id'] != $game['200'][$i]['summonerId']) { ?>
        <div id="<?php echo $_SESSION['user']['id'] . "-" . $game['200'][$i]['summonerId'] . "-" . $gameid?>">
          <button type="button" id="<?php echo $_SESSION['user']['id'] . "-" . $game['200'][$i]['summonerId'] . "-" . $gameid?>" class="btn btn-link review" name="review_summoner">review</button>
        </div>
      <?php } ?> 
      </td>
    </tr>
    <?php } ?>
    </table>
    <?php } ?>
  </div>
  <?php } ?>


