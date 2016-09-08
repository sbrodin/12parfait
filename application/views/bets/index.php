<?php if (is_admin()) : ?>
<a href="<?php echo site_url('admin') ?>"><?php echo $this->lang->line('site_admin');?></a><br/>
<?php endif ?>
<?php
if ($this->session->flashdata('success')) {
    echo $this->session->flashdata('success');
    echo '<br/>';
}
?>
<table class="table-striped table-bordered table-hover">
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
            <a href="<?php echo site_url('bets/edit/'.$fixture->fixture_id) ?>"><?php echo $this->lang->line('add_edit_bet') ?></a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>