<a href="<?php echo site_url('admin') ?>"><?php echo $this->lang->line('back_to_site_admin');?></a><br/>
<a href="<?php echo site_url('admin/championships/add') ?>"><?php echo $this->lang->line('add_championship');?></a><br/>
<?php if ($this->session->flashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $this->session->flashdata('success') ?>
    </div>
<?php endif ?>
<table class="table-striped table-bordered table-hover">
    <tr>
        <th><?php echo $this->lang->line('championship_name') ?></th>
        <th><?php echo $this->lang->line('sport') ?></th>
        <th><?php echo $this->lang->line('country') ?></th>
        <th><?php echo $this->lang->line('level') ?></th>
        <th><?php echo $this->lang->line('year') ?></th>
        <th><?php echo $this->lang->line('activate_deactivate') ?></th>
        <th></th>
    </tr>
    <?php foreach ($championships as $num => $championship) : ?>
    <tr>
        <td><?php echo $championship->name ?></td>
        <td><?php echo ucfirst($championship->sport) ?></td>
        <td><?php echo ucfirst($championship->country) ?></td>
        <td><?php echo $championship->level ?></td>
        <td><?php echo $championship->year ?></td>
        <td>
            <?php if ($championship->status === 'open') : ?>
                <a href="<?php echo site_url('admin/championships/deactivate/'.$championship->championship_id) ?>"><?php echo $this->lang->line('deactivate_championship') ?></a>
            <?php else : ?>
                <a href="<?php echo site_url('admin/championships/activate/'.$championship->championship_id) ?>"><?php echo $this->lang->line('activate_championship') ?></a>
            <?php endif; ?>
        </td>
        <td>
            <a href="<?php echo site_url('admin/championships/edit/'.$championship->championship_id) ?>"><?php echo $this->lang->line('edit_championship') ?></a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>