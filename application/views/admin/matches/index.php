<a href="<?php echo site_url('admin/matches/championship') ?>"><?php echo $this->lang->line('add_match');?></a><br/>
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
            <th><?php echo $this->lang->line('championship_name') ?></th>
            <th><?php echo $this->lang->line('sport') ?></th>
            <th><?php echo $this->lang->line('country') ?></th>
            <th><?php echo $this->lang->line('level') ?></th>
            <th><?php echo $this->lang->line('year') ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($championships as $num => $championship) : ?>
        <tr>
            <td><?php echo $championship->name ?></td>
            <td><?php echo ucfirst($championship->sport) ?></td>
            <td><?php echo ucfirst($championship->country) ?></td>
            <td><?php echo $championship->level ?></td>
            <td><?php echo $championship->year ?></td>
            <td>
                <a href="<?php echo site_url('admin/matches/edit/'.$championship->championship_id) ?>"><?php echo $this->lang->line('edit_matches') ?></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>