<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/managemobile/umts_stick') ?>" id="list"><?php echo lang('umts_stick_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('UMTS_Stick.Managemobile.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/managemobile/umts_stick/create') ?>" id="create_new"><?php echo lang('umts_stick_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>