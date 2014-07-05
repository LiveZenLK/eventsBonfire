<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/managemobile/mobile') ?>" id="list"><?php echo lang('mobile_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Mobile.Managemobile.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/managemobile/mobile/create') ?>" id="create_new"><?php echo lang('mobile_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>