<a href="<?php echo site_url('admin') ?>"><?php echo $this->lang->line('back_to_site_admin') ?></a><br/>
<a href="<?php echo site_url('admin/matches') ?>"><?php echo $this->lang->line('back_to_matchen') ?></a><br/>
<?php echo validation_errors(); ?>

<?php echo form_open('admin/matches/add'); ?>
    <label for="match_name"><?php echo $this->lang->line('match_name') ?> : </label><input type="text" id="match_name" name="match_name" value="<?php echo set_value('match_name') ?>" required="required">
    <input type="submit" value="<?php echo $this->lang->line('add') ?>">
</form>
