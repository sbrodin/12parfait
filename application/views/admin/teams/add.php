<a href="<?= site_url('admin/teams') ?>" class="btn btn-sm btn-outline-primary m-b-1"><?= $this->lang->line('back_to_teams_admin');?></a><br/>
<?= validation_errors() ?>

<?= form_open('admin/teams/add') ?>
    <label for="team_name"><?= $this->lang->line('team_name') ?> : </label>
    <input type="text" id="team_name" name="team_name" value="<?= set_value('team_name') ?>" required="required" autofocus>
    <label for="team_short_name"><?= $this->lang->line('team_short_name') ?> : </label>
    <input type="text" id="team_short_name" name="team_short_name" value="<?= set_value('team_short_name') ?>" required="required" autofocus>
    <input type="submit" value="<?= $this->lang->line('add') ?>">
</form>
