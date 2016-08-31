<a href="<?php echo site_url() ?>"><?php echo $this->lang->line('home');?></a>
<?php if (is_connected()) : ?>
    <a href="<?php echo site_url('profile') ?>"><?php echo $this->lang->line('profile');?></a>
    <a href="<?php echo site_url('connection/logout') ?>"><?php echo $this->lang->line('log_out');?></a>
    <br/>
<?php endif; ?>