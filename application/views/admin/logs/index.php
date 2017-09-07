<a href="<?= site_url('admin') ?>" class="btn btn-sm btn-outline-primary m-b-1"><?= $this->lang->line('back_to_site_admin');?></a><br/>
<div class="overflow">
    <table class="table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th></th>
                <th><?= $this->lang->line('log_controller') ?></th>
                <th><?= $this->lang->line('log_method') ?></th>
                <th><?= $this->lang->line('log_userip') ?></th>
                <th><?= $this->lang->line('log_userid') ?></th>
                <th><?= $this->lang->line('log_message') ?></th>
                <th><?= $this->lang->line('log_date') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $log) : ?>
            <tr>
                <td><?= $log->log_id ?></td>
                <td><?= $log->log_controller ?></td>
                <td><?= $log->log_method ?></td>
                <td><a href="http://www.ip-tracker.org/locator/ip-lookup.php?ip=<?= $log->log_userip ?>" target="_blank"><?= $log->log_userip ?></a></td>
                <td><?= $log->log_userid ?></td>
                <td><?= $log->log_message ?></td>
                <td><?= $log->log_date ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>