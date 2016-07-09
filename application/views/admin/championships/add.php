<a href="<?php echo site_url('admin') ?>"><?php echo $this->lang->line('back_to_site_admin') ?></a><br/>
<a href="<?php echo site_url('admin/championships') ?>"><?php echo $this->lang->line('back_to_championships_admin') ?></a><br/>
<?php echo validation_errors(); ?>

<?php echo form_open('admin/championships/add'); ?>
    <label for="sport"><?php echo $this->lang->line('sport') ?> : </label>
    <select id="sport" name="sport" required="required">
    	<option value="<?php echo $this->lang->line('football') ?>"><?php echo $this->lang->line('football') ?></option>
    </select>
    <label for="country"><?php echo $this->lang->line('country') ?> : </label>
    <select id="country" name="country" required="required">
    	<option value="<?php echo $this->lang->line('france') ?>"><?php echo $this->lang->line('france') ?></option>
    </select>
    <label for="level"><?php echo $this->lang->line('level') ?> : </label>
    <select id="level" name="level" required="required">
    	<option value="1">1</option>
    </select>
    <label for="year"><?php echo $this->lang->line('year') ?> : </label><input type="text" id="year" name="year" required="required" min="2016">
    <input type="submit" value="<?php echo $this->lang->line('add') ?>">
</form>
