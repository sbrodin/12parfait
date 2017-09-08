<?php if (user_can('admin_fixtures')) { ?>
    <a href="<?= site_url('admin/fixtures') ?>" class="btn btn-sm btn-outline-primary m-b-1"><?= $this->lang->line('fixtures_admin');?></a><br/>
<?php } ?>
<?php if (user_can('admin_messages')) { ?>
    <a href="<?= site_url('admin/messages') ?>" class="btn btn-sm btn-outline-primary m-b-1"><?= $this->lang->line('messages_admin');?></a><br/>
<?php } ?>
<?php if (user_can('admin_users')) { ?>
    <a href="<?= site_url('admin/users') ?>" class="btn btn-sm btn-outline-primary m-b-1"><?= $this->lang->line('users_admin');?></a><br/>
<?php } ?>
<?php if (user_can('admin_championships')) { ?>
    <a href="<?= site_url('admin/championships') ?>" class="btn btn-sm btn-outline-primary m-b-1"><?= $this->lang->line('championships_admin');?></a><br/>
<?php } ?>
<?php if (user_can('admin_teams')) { ?>
    <a href="<?= site_url('admin/teams') ?>" class="btn btn-sm btn-outline-primary m-b-1"><?= $this->lang->line('teams_admin');?></a><br/>
<?php } ?>
<?php if (user_can('admin_matches')) { ?>
    <a href="<?= site_url('admin/matches') ?>" class="btn btn-sm btn-outline-primary m-b-1"><?= $this->lang->line('matches_admin');?></a><br/>
<?php } ?>
<?php if (user_can('admin_logs')) { ?>
    <a href="<?= site_url('admin/logs') ?>" class="btn btn-sm btn-outline-primary m-b-1"><?= $this->lang->line('logs_admin');?></a><br/>
<?php } ?>