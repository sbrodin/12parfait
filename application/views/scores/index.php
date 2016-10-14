<table class="table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th></th>
            <th><?= $this->lang->line('user_name') ?></th>
            <th><?= $this->lang->line('score') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $rank = 1;
        $current_score = '';
        foreach ($user_scores as $user_id => $score) :
        ?>
        <tr>
            <?php
            // On n'affiche le rang que s'il est différent du précédent
            if ($score !== $current_score) :
                $current_score = $score;
            ?>
                <td class="text-xs-center"><?= $rank ?></td>
            <?php else : ?>
                <td></td>
            <?php endif; ?>
            <td><?= $users[$user_id] ?></td>
            <td><?= $score ?></td>
        </tr>
        <?php
            ++$rank;
        endforeach;
        ?>
    </tbody>
</table>