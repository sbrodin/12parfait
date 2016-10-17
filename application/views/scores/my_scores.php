<?php if (!empty($info)) : ?>
    <span><?= $info ?></span>
<?php else : ?>
    <div class="card card-block col-md-6">
        <h3 class="card-title">
            <span><?= $scores[0]->first_name ?></span> <span><?= $scores[0]->last_name ?></span>
        </h3>
        <h5 class="card-title">
            <span><?= $scores[0]->user_name ?></span> - <span><?= $scores[0]->total.$this->lang->line('points_short') ?></span>
        </h5>
        <?php if ($required_user_id === $my_user_id) : ?>
            <div class="card-text">
                <span><?= sprintf($this->lang->line('you_have_x_scores_12'), $scores_12) ?><?= $scores_12>0 ? ' '.$this->lang->line('congratulations') : '' ?></span>
            </div>
            <div class="card-text">
                <span><?= sprintf($this->lang->line('you_have_x_scores_7'), $scores_7) ?></span>
            </div>
            <div class="card-text">
                <span><?= sprintf($this->lang->line('you_have_x_scores_6'), $scores_6) ?></span>
            </div>
            <div class="card-text">
                <span><?= sprintf($this->lang->line('you_have_x_scores_4'), $scores_4) ?></span>
            </div>
            <div class="card-text">
                <span><?= sprintf($this->lang->line('you_have_x_scores_3'), $scores_3) ?></span>
            </div>
            <div class="card-text">
                <span><?= sprintf($this->lang->line('you_have_x_scores_0'), $scores_0) ?><?= $scores_0>10 ? ' '.$this->lang->line('can_do_better') : '' ?></span>
            </div>
        <?php else : ?>
            <div class="card-text">
                <span><?= sprintf($this->lang->line('player_has_x_scores_12'), $scores_12) ?></span>
            </div>
            <div class="card-text">
                <span><?= sprintf($this->lang->line('player_has_x_scores_7'), $scores_7) ?></span>
            </div>
            <div class="card-text">
                <span><?= sprintf($this->lang->line('player_has_x_scores_6'), $scores_6) ?></span>
            </div>
            <div class="card-text">
                <span><?= sprintf($this->lang->line('player_has_x_scores_4'), $scores_4) ?></span>
            </div>
            <div class="card-text">
                <span><?= sprintf($this->lang->line('player_has_x_scores_3'), $scores_3) ?></span>
            </div>
            <div class="card-text">
                <span><?= sprintf($this->lang->line('player_has_x_scores_0'), $scores_0) ?></span>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>

<div class="clearfix"></div>