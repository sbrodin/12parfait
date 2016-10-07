<a class="home-logo" href="<?php echo site_url() ?>"><?php echo img('logo.png', $this->lang->line('home'), $this->lang->line('link_to_home')); ?></a>
<?php if (is_connected()) : ?>
    <nav class="profile-log">
    <?php if (user_can('admin_all')) : ?>
        <a href="<?php echo site_url('admin') ?>"><?php echo $this->lang->line('site_admin');?></a>
    <?php endif; ?>
        <a href="<?php echo site_url('profile') ?>"><?php echo $this->lang->line('profile'); ?></a>
        <a href="<?php echo site_url('connection/logout') ?>"><?php echo $this->lang->line('log_out'); ?></a>
    </nav>
    <nav>
        <a href="<?php echo site_url('bets') ?>"><?php echo $this->lang->line('place_bet');?></a>
        <a href="<?php echo site_url('scores') ?>"><?php echo $this->lang->line('view_ladder');?></a>
        <a href="<?php echo site_url('scores/'.$this->session->userdata['user']->user_id) ?>"><?php echo $this->lang->line('view_my_scores');?></a>
    </nav>
<?php else : ?>
    <nav class="profile-log">
        <a href="<?php echo site_url('connection') ?>"><?php echo $this->lang->line('log_in');?></a>
    </nav>
<?php endif; ?>

