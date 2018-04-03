<a class="btn btn-sm btn-secondary m-b-2" href="<?= site_url() ?>"><?= $this->lang->line('back') ?></a><br/>
<?php if ($this->session->user->user_name === '') : ?>
    <div class="alert alert-info alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?= sprintf($this->lang->line('define_username_profile'), site_url('profile')) ?>
    </div>
<?php endif ?>

<?= form_open('scores', array('class' => 'form-scores-filter m-b-2')) ?>
    <span class="form-scores-filter-legend m-r-3"><?= $this->lang->line('filters') ?></span>
    <a class="btn btn-link form-scores-filter-link" data-toggle="collapse" href="#fieldset-filters-scores" aria-expanded="false" aria-controls="fieldset-filters-scores"><?= $this->lang->line('show_hide') ?></a>
    <fieldset id="fieldset-filters-scores" class="form-group collapse <?= $collapse_filters ?>">
        <?php if (isset($bet_filter_message) && user_can('debug')) : ?>
            <div class="jumbotron">
                <?= $bet_filter_message ?>
            </div>
        <?php endif; ?>
        <label for="championship"><?= $this->lang->line('championship')?> : </label>
        <select name="championship" class="form-control form-scores-filter-championship" data-filter-page="scores">
            <option value="0"></option>
            <?php foreach ($championships as $championship_id => $championship_name) : ?>
            <option value="<?= $championship_id ?>" <?= $filters_scores['championship'] == $championship_id ? 'selected' : '' ?>><?= $championship_name ?></option>
            <?php endforeach; ?>
        </select>
        <label for="fixture"><?= $this->lang->line('fixture')?> : </label>
        <select name="fixture" class="form-control form-scores-filter-fixture" data-filter-page="scores">
            <option value="0"></option>
            <?php foreach ($fixtures as $key => $fixture_info) : ?>
            <option value="<?= $fixture_info->fixture_id ?>" data-championship-id="<?= $fixture_info->championship_id ?>" <?= $filters_scores['fixture'] == $fixture_info->fixture_id ? 'selected' : '' ?>><?= $fixture_info->championship_name . ' - ' . $fixture_info->fixture_name ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" name="submit" class="btn btn-sm btn-primary m-t-2 m-b-2" value="<?= $this->lang->line('filter_verb') ?>">
        <input type="submit" name="submit" class="btn btn-sm btn-outline-primary m-t-2 m-b-2" value="<?= $this->lang->line('del_filter') ?>">
    </fieldset>
</form>

<table class="podium m-b-2">
    <tr>
        <td width="33%"></td>
        <td width="33%" class="rank-1">1</td>
        <td width="33%"></td>
    </tr>
    <tr>
        <td width="33%" class="rank-2">2</td>
        <td width="33%" class="border rank-1" rowspan="3">
            <div><?= $rank1_users ?></div>
        </td>
        <td width="33%"></td>
    </tr>
    <tr>
        <td width="33%" class="border rank-2" rowspan="2">
            <div><?= $rank2_users ?></div>
        </td>
        <td width="33%" class="rank-3">3</td>
    </tr>
    <tr>
        <td width="33%" class="border rank-3">
            <div><?= $rank3_users ?></div>
        </td>
    </tr>
</table>

<table class="table-striped table-bordered table-hover score-table">
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th><?= $this->lang->line('user_name') ?></th>
            <th><?= $this->lang->line('score') ?></th>
            <?php if (isset($scores_12)) : ?>
            <th><?= $this->lang->line('nb_12parfait') ?></th>
            <?php endif; ?>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $current_score = '';
        $rank = 1;
        foreach ($user_scores as $user_id => $score) :
            $trophy = null;
            if (strpos($rank1_users, $users[$user_id]) !== false) {
                $trophy = 1;
            } else if (strpos($rank2_users, $users[$user_id]) !== false) {
                $trophy = 2;
            } else if (strpos($rank3_users, $users[$user_id]) !== false) {
                $trophy = 3;
            }
        ?>
        <tr data-href="<?= site_url('scores/'.$user_id) ?>">
            <?php if ($trophy !== null) : ?>
                <td class="rank-<?= $trophy ?> text-xs-center"><i class="fa fa-trophy"></i></td>
            <?php else : ?>
                <td></td>
            <?php endif; ?>
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
            <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('scores/'.$user_id) ?>"><?= $this->lang->line('view') ?></a></td>
        </tr>
        <?php
            ++$rank;
        endforeach;
        ?>
    </tbody>
</table>