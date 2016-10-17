<a href="<?= site_url('admin/fixtures') ?>"><?= $this->lang->line('back_to_fixtures_admin') ?></a><br/>
<?= validation_errors() ?>

<?php if (!empty($info)) : ?>
    <span><?= $info ?></span>
<?php else : ?>
    <?php if (!empty($error_duplicate)) : ?>
        <span><?= $error_duplicate ?></span><br/><br/>
    <?php endif; ?>
    <label for="championship"><?= $this->lang->line('championship') ?> : </label>
    <span id="championship"><?= $championship_name ?></span><br/>
    <label for="fixture"><?= $this->lang->line('fixture') ?> : </label>
    <span id="fixture"><?= $fixture_name ?></span><br/><br/>
    <?= form_open('admin/fixtures/edit/' . $fixture_id) ?>
        <?php
        foreach ($fixture_matches as $key => $fixture_match) :
            $date = date_create_from_format('Y-m-d H:i:s', $fixture_match->date);
            $fixture_match->date = $date->format('d/m/Y H:i');
        ?>
        <label for="match_<?= $key ?>_date"><?= $this->lang->line('match_date') ?> : </label>
        <input type="text" name="date_<?= $key ?>" id="date_<?= $key ?>" class="match_date" required="required" value="<?= $fixture_match->date ?>" ><br/>
        <select id="match_<?= $key ?>_1" name="match_<?= $key ?>_1" required="required">
            <?php foreach ($teams as $team_id => $team_name) : ?>
            <option value="<?= $team_id ?>" <?= ($fixture_match->t1_id==$team_id) ? 'selected' : '' ?> ><?= $team_name ?></option>
            <?php endforeach; ?>
        </select>
        <span> - </span>
        <select id="match_<?= $key ?>_2" name="match_<?= $key ?>_2" required="required">
            <?php foreach ($teams as $team_id => $team_name) : ?>
            <option value="<?= $team_id ?>" 
                <?= ($fixture_match->t2_id==$team_id) ? 'selected' : '' ?> ><?= $team_name ?></option>
            <?php endforeach; ?>
        </select><br/>
        <input type="hidden" name="match_id_<?= $key ?>" id="match_id_<?= $key ?>" value="<?= $fixture_match->match_id ?>" ><br/>
        <br/>
        <?php endforeach; ?>
        <input type="submit" value="<?= $this->lang->line('confirm') ?>">
    </form>
<?php endif; ?>
