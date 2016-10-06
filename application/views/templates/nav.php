<a class="home-logo" href="<?php echo site_url() ?>"><?php echo img('logo.png', $this->lang->line('home'), $this->lang->line('link_to_home')); ?></a><br/>
<?php if (is_connected()) : ?>
    <a href="<?php echo site_url('profile') ?>"><?php echo $this->lang->line('profile'); ?></a>
    <a href="<?php echo site_url('connection/logout') ?>"><?php echo $this->lang->line('log_out'); ?></a>
    <br/>
<?php endif; ?>