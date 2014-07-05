<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/managesim/umts_sim') ?>" id="list"><?php echo lang('umts_sim_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('UMTS_SIM.Managesim.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/managesim/umts_sim/create') ?>" id="create_new"><?php echo lang('umts_sim_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>