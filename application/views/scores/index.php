<table class="table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th><?php echo $this->lang->line('user_name') ?></th>
            <th><?php echo $this->lang->line('score') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($user_scores as $user_id => $score) :
        ?>
        <tr>
            <td><?php echo $users[$user_id] ?></td>
            <td><?php echo $score ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>