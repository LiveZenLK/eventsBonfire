<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/setmasters/fp_set_master') ?>" id="list"><?php echo lang('fp_set_master_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('FP_Set_Master.Setmasters.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/setmasters/fp_set_master/create') ?>" id="create_new"><?php echo lang('fp_set_master_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>