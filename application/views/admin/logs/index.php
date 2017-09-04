<a href="<?= site_url('admin') ?>" class="btn btn-sm btn-outline-primary m-b-1"><?= $this->lang->line('back_to_site_admin');?></a><br/>
<div class="overflow">
    <table class="table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th></th>
                <th><?= $this->lang->line('log_type') ?></th>
                <th><?= $this->lang->line('log_message') ?></th>
                <th><?= $this->lang->line('log_date') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $log) : ?>
            <tr>
                <td><?= $log->log_id ?></td>
                <td><?= $log->log_type ?></td>
                <td><?= $log->log_message ?></td>
                <td><?= date_format(date_create($log->log_date), 'd/m/Y à H\hi') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>