<?php if (!is_connected()) : ?>
    <a href="<?php echo site_url('connection') ?>"><?php echo $this->lang->line('log_in');?></a>
<?php else : ?>
    <?php if (user_can('admin_all')) : ?>
        <a href="<?php echo site_url('admin') ?>"><?php echo $this->lang->line('site_admin');?></a>
    <?php endif; ?>
    <br/>
    <a href="<?php echo site_url('bets') ?>"><?php echo $this->lang->line('place_bet');?></a>
<?php endif; ?>