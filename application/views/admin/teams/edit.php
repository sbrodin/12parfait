<a href="<?= site_url('admin/teams') ?>"><?= $this->lang->line('back_to_teams_admin') ?></a><br/>
<?= validation_errors(); ?>

<?= form_open('admin/teams/edit/'.$team->team_id); ?>
    <label for="team_name"><?= $this->lang->line('team_name') ?> : </label>
    <input type="text" id="team_name" name="team_name" value="<?= $team->name ?>" required="required" autofocus>
    <label for="team_short_name"><?= $this->lang->line('team_short_name') ?> : </label>
    <input type="text" id="team_short_name" name="team_short_name" value="<?= $team->short_name ?>" required="required" autofocus>
    <input type="submit" value="<?= $this->lang->line('confirm') ?>">
</form>
