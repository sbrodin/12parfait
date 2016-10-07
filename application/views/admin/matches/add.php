<a href="<?php echo site_url('admin/matches') ?>"><?php echo $this->lang->line('back_to_matches_admin') ?></a><br/>
<?php echo validation_errors(); ?>

<?php
if (!empty($matches_fixture)) {
    $date = '';
    foreach ($matches_fixture as $key => $match_fixture) {
        if ($match_fixture->date!==$date) {
            $date_not_formatted = date_create_from_format('Y-m-d H:i:s', $match_fixture->date);
            $date_formatted = $date_not_formatted->format('d/m/Y H\hi');
            echo '<br/>' . $date_formatted . '<br/>';
            $date = $match_fixture->date;
        }
        echo $match_fixture->team1 . ' - ' . $match_fixture->team2 . '<br/>';
    }
    echo '<br/>';
}
?>

<?php if (!empty($info)) : ?>
    <span><?php echo $info ?></span>
<?php else : ?>
    <label for="championship"><?php echo $this->lang->line('championship') ?> : </label>
    <span id="championship"><?php echo $championship_name ?></span><br/>
    <label for="fixture"><?php echo $this->lang->line('fixture') ?> : </label>
    <span id="fixture"><?php echo $fixture_name ?></span><br/>
    <?php echo form_open('admin/matches/add'); ?>
        <label for="team1"><?php echo $this->lang->line('team1') ?> : </label>
        <select id="team1" name="team1" autofocus>
            <?php foreach ($teams as $key => $team) : ?>
            <option value="<?php echo $team->team_id ?>" ><?php echo $team->team_name ?></option>
            <?php endforeach; ?>
        </select><br/>
        <label for="team2"><?php echo $this->lang->line('team2') ?> : </label>
        <select id="team2" name="team2">
            <?php foreach ($teams as $key => $team) : ?>
            <option value="<?php echo $team->team_id ?>" ><?php echo $team->team_name ?></option>
            <?php endforeach; ?>
        </select><br/>
        <label for="match_date"><?php echo $this->lang->line('match_date') ?> : </label>
        <input type="text" name="match_date" id="match_date" required="required" value="<?php echo set_value('match_date') ?>" ><br/>
        <input type="submit" value="<?php echo $this->lang->line('add') ?>">
    </form>
<?php endif; ?>