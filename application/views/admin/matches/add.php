<a href="<?php echo site_url('admin') ?>"><?php echo $this->lang->line('back_to_site_admin') ?></a><br/>
<a href="<?php echo site_url('admin/matches') ?>"><?php echo $this->lang->line('back_to_matches_admin') ?></a><br/>
<?php echo validation_errors(); ?>

<?php
if (!empty($matches_fixture)) {
    echo '<br/>';
    foreach ($matches_fixture as $key => $match_fixture) {
        echo $match_fixture->team1 . ' - ' . $match_fixture->team2 . '<br/>';
    }
    echo '<br/>';
}
?>

<?php echo form_open('admin/matches/add'); ?>
    <label for="team1"><?php echo $this->lang->line('team1') ?> : </label>
    <select id="team1" name="team1">
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
    <input type="text" name="match_date" id="match_date" required="required" value="<?php echo set_value('match_date'); ?>" ><br/>
    <input type="submit" value="<?php echo $this->lang->line('add') ?>">
</form>

<script type="text/javascript" src="<?php echo js_url('jquery-3.1.0.min') ?>"></script>
<script type="text/javascript" src="<?php echo js_url('jquery.datetimepicker.full.min') ?>"></script>
<script type="text/javascript">
    $('#match_date').datetimepicker({
        format:'d/m/Y H:i',
        lang:'fr'
    });
</script>