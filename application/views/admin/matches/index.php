<a href="<?= site_url('onarie') ?>" class="btn btn-sm btn-outline-primary m-b-1"><?= $this->lang->line('back_to_site_admin');?></a><br/>
<a href="<?= site_url('onarie/matches/championship') ?>" class="btn btn-sm btn-outline-primary m-b-1"><?= $this->lang->line('add_match');?></a><br/>
<?php if ($this->session->flashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?= $this->session->flashdata('success') ?>
    </div>
<?php endif ?>
<table class="table-striped table-bordered table-hover message-table">
    <thead>
        <tr>
            <th><?= $this->lang->line('championship_name') ?></th>
            <th><?= $this->lang->line('sport') ?></th>
            <th><?= $this->lang->line('country') ?></th>
            <th><?= $this->lang->line('level') ?></th>
            <th><?= $this->lang->line('year') ?></th>
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
                <a class="btn btn-sm btn-primary" href="<?= site_url('onarie/matches/edit/'.$championship->championship_id) ?>"><?= $this->lang->line('edit_matches') ?></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>