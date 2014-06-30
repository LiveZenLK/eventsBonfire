<div class="masthead">
    <ul class="nav nav-pills pull-right">
        <?php if (empty($current_user)) :?>
            <li><a href="<?php echo site_url(LOGIN_URL); ?>">Sign In</a></li>
        <?php else: ?>
            <li><a href="<?php echo site_url('/logout') ?>"><?php e( lang('bf_action_logout')); ?></a></li>
        <?php endif; ?>
    </ul>

    <h3 class="muted"><?php if (class_exists('Settings_lib')) e(settings_item('site.title')); else echo 'Bonfire'; ?></h3>
</div>

