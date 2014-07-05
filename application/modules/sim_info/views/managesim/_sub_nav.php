<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/managesim/sim_info') ?>" id="list"><?php echo lang('sim_info_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('SIM_Info.Managesim.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/managesim/sim_info/create') ?>" id="create_new"><?php echo lang('sim_info_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>