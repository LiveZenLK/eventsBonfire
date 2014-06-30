

<div class="jumbotron" text-align="center">
	
	<div class="leftDiv">
		<img src="/eventsBonfire/public/themes/default/images/phones1.png"/>
	</div>
	<div class="rightDiv">
		<h1><img src="/eventsBonfire/public/themes/default/images/ruptly.jpg"/></h1>
	
		<p class="lead">Welcome to RUPTLY</p>
	
		<?php if (isset($current_user->email)) : ?>
			<a href="<?php echo site_url(SITE_AREA) ?>" class="btn btn-large btn-success">Go to the Admin area</a>
		<?php else :?>
			<a href="<?php echo site_url(LOGIN_URL); ?>" class="btn btn-large btn-primary"><?php echo lang('bf_action_login'); ?></a>
		<?php endif;?>
		
		
	</div>
	 

</div>

