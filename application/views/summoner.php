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
        <a href="#">review</a>
      </td>
      <td >
        <table >
          <tr>
            <td>
              Game-sense
            </td>
            <td>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill1"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill1" . "_" . 1; ?>" value="1" >1</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill1"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill1" . "_" . 2; ?>"value="2" >2</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill1"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill1" . "_" . 3; ?>" value="3" checked>3</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill1"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill1" . "_" . 4; ?>" value="4" >4</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill1"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill1" . "_" . 5; ?>" value="5" >5</label>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              Helpful
            </td>
            <td>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill2"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill2" . "_" . 1; ?>" value="1" >1</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill2"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill2" . "_" . 2; ?>"value="2" >2</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill2"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill2" . "_" . 3; ?>" value="3" checked>3</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill2"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill2" . "_" . 4; ?>" value="4" >4</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill2"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill2" . "_" . 5; ?>" value="5" >5</label>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              Skillful
            </td>
            <td>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill3"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill3" . "_" . 1; ?>" value="1" >1</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill3"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill3" . "_" . 2; ?>"value="2" >2</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill3"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill3" . "_" . 3; ?>" value="3" checked>3</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill3"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill3" . "_" . 4; ?>" value="4" >4</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill3"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill3" . "_" . 5; ?>" value="5" >5</label>
              </div>
            </td>
          </tr>
          <tr>
            <td>
            Delivery
            </td>
            <td>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill4"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill4" . "_" . 1; ?>" value="1" >1</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill4"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill4" . "_" . 2; ?>"value="2" >2</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill4"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill4" . "_" . 3; ?>" value="3" checked>3</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill4"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill4" . "_" . 4; ?>" value="4" >4</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill4"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['100'][$i]['summonerId'] . "_skill4" . "_" . 5; ?>" value="5" >5</label>
              </div>
            </td>
          </tr>
        </table>
      </td>
      <td>
        <input type="submit" value="Submit Review" class="btn btn-default btn-sm" />
      </td>
    </tr>
    <?php } ?>
    </table>

    <table class="table table-condensed">
    <?php for ($i=0; $i < count($game['200']); $i++) { ?>
    <tr>
      <td>
        <?php if(isset($game['100'][$i]['championSprite'])) { ?>
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
        <a href="#">review</a>
      </td>
      <td>
        <table >
          <tr>
            <td>
              Game-sense
            </td>
            <td>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill1"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill1" . "_" . 1; ?>" value="1" >1</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill1"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill1" . "_" . 2; ?>"value="2" >2</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill1"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill1" . "_" . 3; ?>" value="3" checked>3</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill1"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill1" . "_" . 4; ?>" value="4" >4</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill1"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill1" . "_" . 5; ?>" value="5" >5</label>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              Helpful
            </td>
            <td>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill2"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill2" . "_" . 1; ?>" value="1" >1</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill2"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill2" . "_" . 2; ?>"value="2" >2</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill2"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill2" . "_" . 3; ?>" value="3" checked>3</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill2"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill2" . "_" . 4; ?>" value="4" >4</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill2"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill2" . "_" . 5; ?>" value="5" >5</label>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              Skillful
            </td>
            <td>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill3"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill3" . "_" . 1; ?>" value="1" >1</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill3"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill3" . "_" . 2; ?>"value="2" >2</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill3"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill3" . "_" . 3; ?>" value="3" checked>3</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill3"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill3" . "_" . 4; ?>" value="4" >4</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill3"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill3" . "_" . 5; ?>" value="5" >5</label>
              </div>
            </td>
          </tr>
          <tr>
            <td>
            Delivery
            </td>
            <td>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill4"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill4" . "_" . 1; ?>" value="1" >1</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill4"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill4" . "_" . 2; ?>"value="2" >2</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill4"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill4" . "_" . 3; ?>" value="3" checked>3</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill4"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill4" . "_" . 4; ?>" value="4" >4</label>
              </div>
              <div class="radio-inline">
                <label><input type="radio" name="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill4"; ?>"  id="<?php echo $_SESSION['user']['id']."_" . $gameid . "_" . $game['200'][$i]['summonerId'] . "_skill4" . "_" . 5; ?>" value="5" >5</label>
              </div>
            </td>
          </tr>
        </table>
      </td>
      <td>
        <input type="submit" value="Submit Review" class="btn btn-default btn-sm" />
      </td>
    </tr>
    <?php } ?>
    </table>

    <?php } ?>
  </div>
  <?php } ?>


