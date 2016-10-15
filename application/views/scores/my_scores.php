<table class="table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th></th>
            <th><?= $this->lang->line('user_name') ?></th>
            <th><?= $this->lang->line('score') ?></th>
            <?php if (isset($scores_12)) : ?>
            <th><?= $this->lang->line('nb_12parfait') ?></th>
            <?php endif; ?>
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
            <?php if (isset($scores_12)) : ?>
            <td><?= $scores_12 ?></td>
            <?php endif; ?>
        </tr>
        <?php
            ++$rank;
        endforeach;
        ?>
    </tbody>
</table>



<div class="card card-block col-md-4">
    <h3 class="card-title">
        <span><?= $scores[0]->first_name ?></span> <span><?= $scores[0]->last_name ?></span>
    </h3>
    <h5 class="card-title">
        <span><?= $scores[0]->user_name ?></span>
    </h5>
    <div class="card-text">
        <span><?= sprintf($this->lang->line('you_have_x_scores_12'), $scores_12) ?></span>
    </div>
    <div class="card-text">
        <span><?= sprintf($this->lang->line('you_have_x_scores_7'), $scores_7) ?></span>
    </div>
    <div class="card-text">
        <span><?= sprintf($this->lang->line('you_have_x_scores_4'), $scores_4) ?></span>
    </div>
    <div class="card-text">
        <span><?= sprintf($this->lang->line('you_have_x_scores_3'), $scores_3) ?></span>
    </div>
    <div class="card-text">
        <span><?= sprintf($this->lang->line('you_have_x_scores_0'), $scores_0) ?></span>
    </div>
</div>

<div class="clearfix"></div>