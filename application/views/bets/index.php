<?php if ($this->session->flashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?= $this->session->flashdata('success') ?>
    </div>
<?php endif ?>

<?= form_open('bets', array('class' => 'form-bets-filter m-b-2')) ?>
    <fieldset class="form-group">
        <legend><?= $this->lang->line('filters') ?></legend>
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
            <option value="<?= $fixture_info->fixture_id ?>" data-championship-id="<?= $fixture_info->championship_id ?>" <?= $filters_bets['fixture'] == $fixture_info->fixture_id ? 'selected' : '' ?>><?= $fixture_info->championship_name . ' - ' . $fixture_info->fixture_name ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" name="submit" class="btn btn-sm btn-primary m-t-2 m-b-2" value="<?= $this->lang->line('filter_verb') ?>">
        <input type="submit" name="submit" class="btn btn-sm btn-primary m-t-2 m-b-2" value="<?= $this->lang->line('del_filter') ?>">
    </fieldset>
</form>

<table class="table-striped table-bordered table-hover table-bets">
    <thead>
        <th><?= $this->lang->line('championship_name') ?></th>
        <th><?= $this->lang->line('fixture_name') ?></th>
        <th></th>
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
            <?php if ($fixture->status === 'open') : ?>
            <a class="btn btn-sm btn-primary" href="<?= site_url('bets/edit/'.$fixture->fixture_id) ?>"><?= $this->lang->line('add_edit_bet') ?></a>
            <?php else : ?>
            <a class="btn btn-sm btn-outline-primary" href="<?= site_url('bets/edit/'.$fixture->fixture_id) ?>"><?= $this->lang->line('results') ?></a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>