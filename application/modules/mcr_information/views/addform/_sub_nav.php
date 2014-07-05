<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/addform/mcr_information') ?>" id="list"><?php echo lang('mcr_information_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('MCR_Information.Addform.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/addform/mcr_information/create') ?>" id="create_new"><?php echo lang('mcr_information_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>