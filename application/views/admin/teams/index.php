<a href="<?= site_url('onarie') ?>" class="btn btn-sm btn-outline-primary m-b-1"><?= $this->lang->line('back_to_site_admin');?></a><br/>
<a href="<?= site_url('onarie/teams/add') ?>" class="btn btn-sm btn-outline-primary m-b-1"><?= $this->lang->line('add_team');?></a><br/>
<?php if ($this->session->flashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?= $this->session->flashdata('success') ?>
    </div>
<?php endif ?>
<table>
    <thead>
        <tr>
            <th><?= $this->lang->line('team_name') ?></th>
            <th><?= $this->lang->line('team_short_name') ?></th>
            <th><?= $this->lang->line('level') ?></th>
            <th><?= $this->lang->line('sport') ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($teams as $key => $team) : ?>
        <tr>
            <td><?= $team->name ?></td>
            <td><?= $team->short_name ?></td>
            <td><?= $team->level ?></td>
            <td><?= $team->sport ?></td>
            <td>
                <a class="btn btn-sm btn-primary" href="<?= site_url('onarie/teams/edit/'.$team->team_id) ?>"><?= $this->lang->line('edit_team') ?></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>