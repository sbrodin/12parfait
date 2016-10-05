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

<?php if (!$matches_of_day) : ?>
    <div><?php echo $this->lang->line('no_match_this_day'); ?></div>
<?php else : ?>
    <table class="table-striped table-hover">
    <tr>
        <td colspan="4" class="text-xs-center"><?php echo $this->lang->line('today_matches'); ?></td>
    </tr>
    <?php foreach ($matches_of_day as $key => $match) : ?>
        <tr>
            <td class="text-xs-right"><?php echo $match->team1 ?></td>
            <td class="text-xs-center">-</td>
            <td class="text-xs-left"><?php echo $match->team2 ?></td>
            <td class="text-xs-center"><?php echo $match->match_time ?></td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php endif; ?>