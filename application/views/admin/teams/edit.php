<a href="<?php echo site_url('admin/teams') ?>"><?php echo $this->lang->line('back_to_teams_admin') ?></a><br/>
<?php echo validation_errors(); ?>

<?php echo form_open('admin/teams/edit/'.$team->team_id); ?>
    <label for="team_name"><?php echo $this->lang->line('team_name') ?> : </label>
    <input type="text" id="team_name" name="team_name" value="<?php echo $team->name ?>" required="required" autofocus>
    <label for="team_short_name"><?php echo $this->lang->line('team_short_name') ?> : </label>
    <input type="text" id="team_short_name" name="team_short_name" value="<?php echo $team->short_name ?>" required="required" autofocus>
    <input type="submit" value="<?php echo $this->lang->line('confirm') ?>">
</form>
