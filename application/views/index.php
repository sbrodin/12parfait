<?php if (!is_connected()) : ?>
    <a href="<?php echo site_url('connection') ?>"><?php echo $this->lang->line('log_in');?></a>
<?php else : ?>
    <?php if (user_can('admin_all')) : ?>
        <a href="<?php echo site_url('admin') ?>"><?php echo $this->lang->line('site_admin');?></a>
    <?php endif; ?>
    <br/>
    <a href="<?php echo site_url('bets') ?>"><?php echo $this->lang->line('place_bet');?></a>
    <br/>
    <a href="<?php echo site_url('scores') ?>"><?php echo $this->lang->line('view_ladder');?></a>
    <br/>
    <a href="<?php echo site_url('scores/'.$this->session->userdata['user']->user_id) ?>"><?php echo $this->lang->line('view_my_scores');?></a>
<?php endif; ?>