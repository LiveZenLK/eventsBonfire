<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/setmasters/drone_master') ?>" id="list"><?php echo lang('drone_master_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Drone_Master.Setmasters.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/setmasters/drone_master/create') ?>" id="create_new"><?php echo lang('drone_master_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>