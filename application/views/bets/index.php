<a class="btn btn-sm btn-secondary m-b-2" href="<?= site_url() ?>"><?= $this->lang->line('back') ?></a><br/>
<?php if ($this->session->flashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?= $this->session->flashdata('success') ?>
    </div>
<?php endif ?>

<?php if (isset($bet_message)) : ?>
    <div class="jumbotron">
        <?= $bet_message ?>
    </div>
<?php endif; ?>

<?= form_open('bets', array('class' => 'form-bets-filter m-b-1')) ?>
    <span class="form-bets-filter-legend m-r-3"><?= $this->lang->line('filters') ?></span>
    <a class="btn btn-link form-bets-filter-link" data-toggle="collapse" href="#fieldset-filters-bets" aria-expanded="false" aria-controls="fieldset-filters-bets"><?= $this->lang->line('show_hide') ?></a>
    <fieldset id="fieldset-filters-bets" class="form-group collapse <?= $collapse_filters ?>">
        <label for="championship"><?= $this->lang->line('championship')?> : </label>
        <select name="championship" class="form-control form-bets-filter-championship" data-filter-page="bets">
            <option value="0"></option>
            <?php foreach ($championships as $championship_id => $championship_name) : ?>
            <option value="<?= $championship_id ?>" <?= $filters_bets['championship'] == $championship_id ? 'selected' : '' ?>><?= $championship_name ?></option>
            <?php endforeach; ?>
        </select>
        <label for="fixture"><?= $this->lang->line('fixture')?> : </label>
        <select name="fixture" class="form-control form-bets-filter-fixture" data-filter-page="bets">
            <option value="0"></option>
            <?php foreach ($fixtures as $key => $fixture_info) : ?>
            <option value="<?= $fixture_info->fixture_id ?>" data-championship-id="<?= $fixture_info->championship_id ?>" <?= $filters_bets['fixture'] == $fixture_info->fixture_id ? 'selected' : '' ?>><?= $fixture_info->championship_name.' - '.$fixture_info->fixture_name ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" name="submit" class="btn btn-sm btn-primary m-t-2 m-b-2" value="<?= $this->lang->line('filter_verb') ?>">
        <input type="submit" name="submit" class="btn btn-sm btn-outline-primary m-t-2 m-b-2" value="<?= $this->lang->line('del_filter') ?>">
    </fieldset>
</form>

<?php
$championship_name = '';
foreach ($fixtures as $num => $fixture) :
    // Lisibilité pour ne pas répéter le nom du championnat
    if ($championship_name !== $fixture->championship_name) {
        if ($championship_name !== '') {
            echo '</div>';
        }
        echo '<div>';
        echo '<h3>'.$fixture->championship_name.'</h3>';
        $championship_name = $fixture->championship_name;
    }
    if ($fixture->status === 'open' || $fixture->status === 'ongoing') {
        $card_theme = 'bettable';
    } else {
        $card_theme = 'non-bettable';
    }
?>
    <div class="card text-xs-center m-b-1 m-r-1 <?= $card_theme ?>">
        <div class="card-body">
            <h6 class="card-title"><?= $fixture->fixture_name ?></h6>
            <div class="card-subtitle m-b-1 text-muted hidden-sm-down"><?= $fixture->championship_name ?></div>
            <?php if (!is_null($fixture->dates['first']) && !is_null($fixture->dates['last'])) : ?>
                <?php if ($fixture->dates['first'] !== $fixture->dates['last']) : ?>
                <div class="card-subtitle text-muted hidden-sm-down"><?= $this->lang->line('from_the') ?> <?= $fixture->dates['first'] ?></div>
                <div class="card-subtitle m-b-1 text-muted hidden-sm-down"><?= $this->lang->line('to') ?> <?= $fixture->dates['last'] ?></div>
                <?php else : ?>
                <div class="card-subtitle m-b-1 text-muted hidden-sm-down"><?= $this->lang->line('on') ?> <?= $fixture->dates['first'] ?></div>
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($fixture->status === 'open' || $fixture->status === 'ongoing') : ?>
            <a class="btn btn-sm btn-primary" href="<?= site_url('bets/edit/'.$fixture->fixture_id) ?>"><?= $this->lang->line('add_edit_bet') ?></a>
            <?php else : ?>
            <a class="btn btn-sm btn-outline-primary" href="<?= site_url('bets/edit/'.$fixture->fixture_id) ?>"><?= $this->lang->line('results') ?></a>
            <?php endif; ?>
            <?php if (user_can('admin_fixtures') && ($fixture->status === 'open' || $fixture->status === 'ongoing')) : ?>
                <a class="btn btn-sm btn-primary" href="<?= site_url('admin/fixtures/results/'.$fixture->fixture_id) ?>"><?= $this->lang->line('enter_fixture_results'); ?></a>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>
</div>

<!-- <table class="table-striped table-bordered table-hover table-bets">
    <thead>
        <th><?= $this->lang->line('championship_name') ?></th>
        <th><?= $this->lang->line('fixture_name') ?></th>
        <th></th>
        <?php if (user_can('admin_fixtures')) : ?>
            <th></th>
        <?php endif; ?>
    </thead>
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
        <td><?= $fixture->fixture_name ?></td>
        <td>
            <?php if ($fixture->status === 'open' || $fixture->status === 'ongoing') : ?>
            <a class="btn btn-sm btn-primary" href="<?= site_url('bets/edit/'.$fixture->fixture_id) ?>"><?= $this->lang->line('add_edit_bet') ?></a>
            <?php else : ?>
            <a class="btn btn-sm btn-outline-primary" href="<?= site_url('bets/edit/'.$fixture->fixture_id) ?>"><?= $this->lang->line('results') ?></a>
            <?php endif; ?>
        </td>
        <?php if (user_can('admin_fixtures')) : ?>
            <?php if ($fixture->status === 'open' || $fixture->status === 'ongoing') : ?>
                <td><a class="btn btn-sm btn-primary" href="<?= site_url('admin/fixtures/results/'.$fixture->fixture_id) ?>"><?= $this->lang->line('enter_fixture_results'); ?></a></td>
            <?php else : ?>
                <td></td>
            <?php endif; ?>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>
</table> -->