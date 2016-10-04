<a href="<?php echo site_url('admin') ?>"><?php echo $this->lang->line('back_to_site_admin') ?></a><br/>
<a href="<?php echo site_url('admin/teams') ?>"><?php echo $this->lang->line('back_to_teams_admin') ?></a><br/>
<?php echo validation_errors(); ?>

<?php echo form_open('admin/teams/add'); ?>
    <label for="team_name"><?php echo $this->lang->line('team_name') ?> : </label>
    <input type="text" id="team_name" name="team_name" value="<?php echo set_value('team_name') ?>" required="required" autofocus>
    <label for="team_short_name"><?php echo $this->lang->line('team_short_name') ?> : </label>
    <input type="text" id="team_short_name" name="team_short_name" value="<?php echo set_value('team_short_name') ?>" required="required" autofocus>
    <input type="submit" value="<?php echo $this->lang->line('add') ?>">
</form>
