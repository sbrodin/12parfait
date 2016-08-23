<a href="<?php echo site_url('admin') ?>"><?php echo $this->lang->line('back_to_site_admin');?></a><br/>
<a href="<?php echo site_url('admin/teams/add') ?>"><?php echo $this->lang->line('add_team');?></a><br/>
<?php
if ($this->session->flashdata('success')) {
    echo $this->session->flashdata('success');
    echo '<br/>';
}
?>
<table>
    <tr>
        <th><?php echo $this->lang->line('team_name') ?></th>
        <th></th>
    </tr>
    <?php foreach ($teams as $num => $team) : ?>
    <tr>
        <td><?php echo $team->name ?></td>
        <td>
            <a href="<?php echo site_url('admin/teams/edit/'.$team->team_id) ?>"><?php echo $this->lang->line('edit_team') ?></a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>