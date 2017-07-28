<a href="<?= site_url('admin/championships/add') ?>" class="btn btn-sm btn-outline-primary m-b-1"><?= $this->lang->line('add_championship');?></a><br/>
<?php if ($this->session->flashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?= $this->session->flashdata('success') ?>
    </div>
<?php endif ?>
<table class="table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th><?= $this->lang->line('championship_name') ?></th>
            <th><?= $this->lang->line('sport') ?></th>
            <th><?= $this->lang->line('country') ?></th>
            <th><?= $this->lang->line('level') ?></th>
            <th><?= $this->lang->line('year') ?></th>
            <th><?= $this->lang->line('activate_deactivate') ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($championships as $num => $championship) : ?>
        <tr>
            <td><?= $championship->name ?></td>
            <td><?= ucfirst($championship->sport) ?></td>
            <td><?= ucfirst($championship->country) ?></td>
            <td><?= $championship->level ?></td>
            <td><?= $championship->year ?></td>
            <td>
                <?php if ($championship->status === 'open') : ?>
                    <a href="<?= site_url('admin/championships/deactivate/'.$championship->championship_id) ?>"><?= $this->lang->line('deactivate_championship') ?></a>
                <?php else : ?>
                    <a href="<?= site_url('admin/championships/activate/'.$championship->championship_id) ?>"><?= $this->lang->line('activate_championship') ?></a>
                <?php endif; ?>
            </td>
            <td>
                <a href="<?= site_url('admin/championships/edit/'.$championship->championship_id) ?>"><?= $this->lang->line('edit') ?></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>