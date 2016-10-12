<table class="table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th><?= $this->lang->line('user_name') ?></th>
            <th><?= $this->lang->line('score') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($user_scores as $user_id => $score) :
        ?>
        <tr>
            <td><?= $users[$user_id] ?></td>
            <td><?= $score ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>