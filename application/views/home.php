<div class="homepage">
	<div class="homepage-header">
		<div class="container">
			<div class="homepage-title text-center">
				<p>A little feedback never hurt.</p>
			</div>
			<div class="homepage-subtitle text-center">
				<p>Bettering the LoL community, one feedback at a time.</p>
			</div>
			<div class="homepage-quote text-center">
				<div class="homepage-quote-content">
					<p>"<?php echo $quote_content ?>"</p>
				</div>
				<div class="homepage-quote-author">
					<p>&mdash;<?php echo $quote_author ?></p>
				</div>
			</div>
		</div>
	</div>
	<!-- HEADER END -->
	
	<!-- START PITCH -->
	<div class="homepage-pitch">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="homepage-pitch-main-title brand">
						LoL Fe<span class="clip"><span class="half"><i class="fa fa-volume-up"></i></span></span>dback
					</div>
				</div>
				<div class="col-md-4">
					<div class="homepage-pitch-main-content">
						<p>LoL Feedback is a platform allowing LoL players to give constructive Feedback to fellow players. Instead of remaining passive after a heated game, LoL Feedback aims at providing informative insight on players' performances by giving a means to reach out to fellow LoL players. Whether that insight be positive or negative, every feedback given counts. </p>
					</div>
				</div>
			</div>
			<div class="homepage-pitch-title">
				<p>What's "Feedback"?</p>
			</div>
			<div class="homepage-pitch-content">
				<p>Feedback is continuously given in everyday life, whether you be at work or playing a sport. It helps shake you up a bit and realize what you did well, or not so well. A LoL Feedback consists of a constructive comment and four individual ratings o tnhe following four gameplay aspects: </p>
			</div>
			<div class="homepage-skills">
				<div class="row">
					<div class="col-md-3">
						<div class="homepage-skill">
							<div class="homepage-skill-name">
								<p>Game-sense</p>
							</div>
							<div class="homepage-skill-icon">
								<i class="fa fa-lightbulb-o"></i>
							</div>
							<div class="homepage-skill-description">
								<p>Deep understanding of team oriented goals, team player, a leader</p>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="homepage-skill">
							<div class="homepage-skill-name">
								<p>Helpful</p>
							</div>
							<div class="homepage-skill-icon">
								<i class="fa fa-thumbs-o-up"></i>
							</div>
							<div class="homepage-skill-description">
								<p>Cooperated, jumped on opportunities to educate and encourage</p>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="homepage-skill">
							<div class="homepage-skill-name">
								<p>Skillful</p>
							</div>
							<div class="homepage-skill-icon">
								<i class="fa fa-magic"></i>
							</div>
							<div class="homepage-skill-description">
								<p>Demonstrated intellectual prowess through adept gameplay</p>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="homepage-skill">
							<div class="homepage-skill-name">
								<p>Delivery</p>
							</div>
							<div class="homepage-skill-icon">
								<i class="fa fa-angellist"></i>
							</div>
							<div class="homepage-skill-description">
								<p>Polite, clear and conscise when communicating in and out of game</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="homepage-pitch-title">
				<p>Not anybody can give you feedback!</p>
			</div>
			<div class="homepage-pitch-content">
				<p>Giving Feedback to fellow player is reserved to summoners who have registered to LoL Feedback <strong>and</strong> have played with or against said summoner.</p>
			</div>

		<?php if(!$is_logged_in) { ?>
		<div class="homepage-start">
			<div class="row">
				<div class="col-sm-2 col-sm-offset-5 text-center">
					<a href="<?php echo site_url('register') ?>" class="btn btn-primary btn-lg">I want in</a>
				</div>
			</div>
		</div>
		<?php } ?>

		</div>
	</div>
	<!-- END PITCH -->
</div>

