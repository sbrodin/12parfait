<a href="<?php echo site_url('admin') ?>"><?php echo $this->lang->line('back_to_site_admin');?></a><br/>
<a href="<?php echo site_url('admin/fixtures/add') ?>"><?php echo $this->lang->line('add_fixture');?></a><br/>
<?php
if ($this->session->flashdata('success')) {
    echo $this->session->flashdata('success');
    echo '<br/>';
}
?>
<table>
    <tr>
        <th><?php echo $this->lang->line('championship_name') ?></th>
        <th><?php echo $this->lang->line('fixture_name') ?></th>
        <th></th>
    </tr>
    <?php
    $championship_name = '';
    foreach ($fixtures as $num => $fixture) :

    ?>
    <tr>
        <td>
        <?php
        // Lisibilité pour ne pas répéter le nom du championnat sur chaque ligne
        if ($championship_name!==$fixture->championship_name) {
            echo $fixture->championship_name;
            $championship_name = $fixture->championship_name;
        }
        ?>
        </td>
        <td><?php echo $fixture->fixture_name ?></td>
        <td>
            <a href="<?php echo site_url('admin/fixtures/edit/'.$fixture->fixture_id) ?>"><?php echo $this->lang->line('edit_fixture') ?></a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>