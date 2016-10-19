<a class="btn btn-sm btn-secondary m-b-2" href="<?= site_url() ?>"><?= $this->lang->line('back') ?></a><br/>
<?php if ($this->session->userdata['user']->user_name === '') : ?>
    <div class="alert alert-info alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?= sprintf($this->lang->line('define_username_profile'), site_url('profile')) ?>
    </div>
<?php endif ?>

<?= validation_errors() ?>

<?= form_open('contact', array('class' => 'form-filter')) ?>
    <select id="fixture" name="fixture">
    <?php foreach ($fixtures as $fixture_id => $name) : ?>
        <option></option>
    <?php endforeach; ?>
    </select>
</form>

<table class="table-striped table-bordered table-hover score-table">
    <thead>
        <tr>
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
        $rank = 1;
        $current_score = '';
        foreach ($user_scores as $user_id => $score) :
        ?>
        <tr data-href="<?= site_url('scores/'.$user_id) ?>">
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