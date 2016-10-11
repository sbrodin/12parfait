<a href="<?php echo site_url('admin/teams/add') ?>"><?php echo $this->lang->line('add_team');?></a><br/>
<?php if ($this->session->flashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $this->session->flashdata('success') ?>
    </div>
<?php endif ?>
<table>
    <thead>
        <tr>
            <th><?php echo $this->lang->line('team_name') ?></th>
            <th><?php echo $this->lang->line('team_short_name') ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($teams as $num => $team) : ?>
        <tr>
            <td><?php echo $team->name ?></td>
            <td><?php echo $team->short_name ?></td>
            <td>
                <a href="<?php echo site_url('admin/teams/edit/'.$team->team_id) ?>"><?php echo $this->lang->line('edit_team') ?></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>