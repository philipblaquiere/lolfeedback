<script language="JavaScript" type="text/javascript">
$(window).load(function() {

    if($('body').is('.summoner'))
    {
        var summonerId = document.getElementsByTagName("body")[0].id
        $("#sr_"+summonerId).html('<div class="row"><div class="col-md-1 col-md-offset-3"><div class="spinner"><i class="fa-li fa fa-spinner fa-spin fa-2x"></i></div></div></div>');

        if(summonerId == "index")
        {
            return;
        }

        $.ajax({
            url: '<?php echo site_url('games/recent') . "/"?>'+summonerId,
            type: 'POST',
            dataType: 'JSON',
            data: {},
            success: function(data){
                if(data.is_user == "true")
                {
                    $("#sg_"+summonerId).html(data.game_content);
                }

                $("#sr_"+summonerId).html('');
                $("#sr_"+summonerId).html(data.review_content);
            },
            error:function(data, jqXHR, textStatus, errorThrown){
                $("#"+summonerId).html('An error has occured loading the profile:' + textStatus +errorThrown);
                return;
            }
        });
    }
});
</script>

<div class="container">
  <div class="summoner-title">
    <div class="row">
      <div class="col-md-7">
         <?php echo $title ?>
      </div>
    </div>
  </div>

  <?php if(!empty($stats)) { ?>
  <div class="summoner-stats">
    <div class="row">
      <?php foreach ($stats as $skill_name => $stat) { ?>
        <div class="col-md-1">
          <div class="stat-value">
            <?php echo $stat ?>
          </div>
          <div class="stat-label">
            <?php echo $skill_name ?>
          </div>
        </div>
      <?php } ?>
      <div class="col-md-2">
        <div class="given-received-block">
          <div class="panel panel-default">
            <div class="panel-body">
            <?php foreach ($review_stats as $review_stat => $review_statcount) { ?>
                <div class="stat-label">
                  <?php echo $review_statcount ?>
                  <?php echo $review_stat ?>
                </div>
            <?php } ?>
           </div>
          </div>
        </div>
      </div>
      <?php if(array_key_exists('user', $_SESSION) && $_SESSION['user']['id'] == $id) { ?>
      <div class="col-md-1">
        <button type="button" class="btn btn-default refresh-feed" id="<?php echo $_SESSION['user']['id'] ?>-refresh" aria-label="Refresh Feed">
         <i class="fa fa-refresh" id="<?php echo $_SESSION['user']['id'] ?>-refresh-spinner"></i></span>
        </button>
      </div>
      <?php } ?>
    </div>
  </div>
  <?php } ?>



  <div id="sg_<?php echo $id ?>" class="summoner-games">
    
  </div>

  <div id="sr_<?php echo $id ?>" class="summoner-reviews">

  </div>
</div>


