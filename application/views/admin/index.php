<?php if (user_can('admin_fixtures')) { ?>
    <a href="<?= site_url('onarie/fixtures') ?>" class="btn btn-sm btn-outline-primary m-b-2 admin-link"><i class="fa fa-calendar" title="<?= $this->lang->line('fixtures_admin');?>" alt="<?= $this->lang->line('fixtures_admin');?>"></i>&nbsp;&nbsp;<?= $this->lang->line('fixtures_admin');?></a><br/>
<?php } ?>
<?php if (user_can('admin_messages')) { ?>
    <a href="<?= site_url('onarie/messages') ?>" class="btn btn-sm btn-outline-primary m-b-2 admin-link"><i class="fas fa-font" title="<?= $this->lang->line('messages_admin');?>" alt="<?= $this->lang->line('messages_admin');?>"></i>&nbsp;&nbsp;<?= $this->lang->line('messages_admin');?></a><br/>
<?php } ?>
<?php if (user_can('admin_users')) { ?>
    <a href="<?= site_url('onarie/users') ?>" class="btn btn-sm btn-outline-primary m-b-2 admin-link"><i class="fa fa-user" title="<?= $this->lang->line('users_admin');?>" alt="<?= $this->lang->line('users_admin');?>"></i>&nbsp;&nbsp;<?= $this->lang->line('users_admin');?></a><br/>
<?php } ?>
<?php if (user_can('admin_championships')) { ?>
    <a href="<?= site_url('onarie/championships') ?>" class="btn btn-sm btn-outline-primary m-b-2 admin-link"><i class="fas fa-trophy" title="<?= $this->lang->line('championships_admin');?>" alt="<?= $this->lang->line('championships_admin');?>"></i>&nbsp;&nbsp;<?= $this->lang->line('championships_admin');?></a><br/>
<?php } ?>
<?php if (user_can('admin_teams')) { ?>
    <a href="<?= site_url('onarie/teams') ?>" class="btn btn-sm btn-outline-primary m-b-2 admin-link"><i class="fas fa-users" title="<?= $this->lang->line('teams_admin');?>" alt="<?= $this->lang->line('teams_admin');?>"></i>&nbsp;&nbsp;<?= $this->lang->line('teams_admin');?></a><br/>
<?php } ?>
<?php if (user_can('admin_matches')) { ?>
    <a href="<?= site_url('onarie/matches') ?>" class="btn btn-sm btn-outline-primary m-b-2 admin-link"><i class="fas fa-users" title="<?= $this->lang->line('matches_admin');?>" alt="<?= $this->lang->line('matches_admin');?>"></i> vs <i class="fas fa-users" title="<?= $this->lang->line('matches_admin');?>" alt="<?= $this->lang->line('matches_admin');?>"></i>&nbsp;&nbsp;<?= $this->lang->line('matches_admin');?></a><br/>
<?php } ?>
<?php if (user_can('admin_logs')) { ?>
    <a href="<?= site_url('onarie/logs') ?>" class="btn btn-sm btn-outline-primary m-b-2 admin-link"><i class="fas fa-list" title="<?= $this->lang->line('logs_admin');?>" alt="<?= $this->lang->line('logs_admin');?>"></i>&nbsp;&nbsp;<?= $this->lang->line('logs_admin');?></a><br/>
<?php } ?>
