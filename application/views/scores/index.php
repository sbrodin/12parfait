<?php if (is_admin()) : ?>
<a href="<?php echo site_url('admin') ?>"><?php echo $this->lang->line('site_admin');?></a><br/>
<?php endif ?>
<table class="table-striped table-bordered table-hover">
    <tr>
        <th><?php echo $this->lang->line('user_name') ?></th>
        <th><?php echo $this->lang->line('score') ?></th>
    </tr>
    <?php
    foreach ($user_scores as $user_id => $score) :
    ?>
    <tr>
        <td><?php echo $users[$user_id] ?></td>
        <td><?php echo $score ?></td>
    </tr>
    <?php endforeach; ?>
</table>