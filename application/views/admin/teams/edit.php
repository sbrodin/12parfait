<a href="<?= site_url('admin/teams') ?>" class="btn btn-sm btn-outline-primary m-b-1"><?= $this->lang->line('back_to_teams_admin');?></a><br/>
<?= validation_errors(); ?>

<?= form_open('admin/teams/edit/'.$team->team_id); ?>
    <div>
        <label for="team_name"><?= $this->lang->line('team_name') ?> : </label>
        <input type="text" id="team_name" name="team_name" value="<?= $team->name ?>" required="required" autofocus>
    </div>
    <div>
        <label for="team_short_name"><?= $this->lang->line('team_short_name') ?> : </label>
        <input type="text" id="team_short_name" name="team_short_name" value="<?= $team->short_name ?>" required="required"  max_length="5">
    </div>
    <div>
        <label for="level"><?= $this->lang->line('level') ?> : </label>
        <select id="level" name="level" required="required">
            <option value="local"><?= $this->lang->line('local') ?></option>
            <option value="national"><?= $this->lang->line('national') ?></option>
        </select>
    </div>
    <input type="submit" value="<?= $this->lang->line('confirm') ?>">
</form>
