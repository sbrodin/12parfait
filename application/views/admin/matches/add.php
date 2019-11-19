<a href="<?= site_url('onarie/matches') ?>" class="btn btn-sm btn-outline-primary m-b-1"><?= $this->lang->line('back_to_matches_admin');?></a><br/>
<?= validation_errors() ?>

<?php
if (!empty($matches_fixture)) {
    $date = '';
    foreach ($matches_fixture as $key => $match_fixture) {
        if ($match_fixture->date!==$date) {
            $date_not_formatted = date_create_from_format('Y-m-d H:i:s', $match_fixture->date);
            $date_formatted = $date_not_formatted->format('d/m/Y H\hi');
            echo '<br/>'.$date_formatted.'<br/>';
            $date = $match_fixture->date;
        }
        echo $match_fixture->team1.' - '.$match_fixture->team2.'<br/>';
    }
    echo '<br/>';
}
?>

<?php if (!empty($info)) : ?>
    <span><?= $info ?></span>
<?php else : ?>
    <label for="championship"><?= $this->lang->line('championship') ?> : </label>
    <span id="championship"><?= $championship_name ?></span><br/>
    <label for="fixture"><?= $this->lang->line('fixture') ?> : </label>
    <span id="fixture"><?= $fixture_name ?></span><br/>
    <?= form_open('onarie/matches/add') ?>
        <label for="team1"><?= $this->lang->line('team1') ?> : </label>
        <select id="team1" name="team1" autofocus>
            <?php foreach ($teams as $key => $team) : ?>
            <option value="<?= $team->team_id ?>" ><?= $team->team_name ?></option>
            <?php endforeach; ?>
        </select><br/>
        <label for="team2"><?= $this->lang->line('team2') ?> : </label>
        <select id="team2" name="team2">
            <?php foreach ($teams as $key => $team) : ?>
            <option value="<?= $team->team_id ?>" ><?= $team->team_name ?></option>
            <?php endforeach; ?>
        </select><br/>
        <label for="match_date"><?= $this->lang->line('match_date') ?> : </label>
        <input type="text" name="match_date" id="match_date" class="match_date" required="required" value="<?= set_value('match_date') ?>" ><br/>
        <input type="submit" value="<?= $this->lang->line('add') ?>">
    </form>
<?php endif; ?>