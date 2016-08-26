<a href="<?php echo site_url('admin') ?>"><?php echo $this->lang->line('back_to_site_admin') ?></a><br/>
<a href="<?php echo site_url('admin/fixtures') ?>"><?php echo $this->lang->line('back_to_fixtures_admin') ?></a><br/>
<?php echo validation_errors(); ?>

<?php echo form_open('admin/fixtures/add'); ?>
    <?php if (!empty($this->session->userdata['championship'])) : ?>
    <input type="hidden" id="championship" name="championship" value="<?php echo $this->session->userdata['championship'] ?>">
    <?php else : ?>
    <label for="championship"><?php echo $this->lang->line('championship') ?> : </label>
    <select id="championship" name="championship" required="required">
        <?php foreach ($championships as $key => $championship) : ?>
        <option value="<?php echo $championship->championship_id ?>" 
            selected="<?php echo (!empty($this->session->userdata['championship']) && $this->session->userdata['championship']==$championship->championship_id) ? 'selected' : '' ?>" ><?php echo $championship->name ?></option>
        <?php endforeach; ?>
    </select><br/>
    <?php endif; ?>
    <label for="fixture_name"><?php echo $this->lang->line('fixture_name') ?> : </label>
    <input type="text" id="fixture_name" name="fixture_name" value="<?php echo set_value('fixture_name') ?>" required="required">
    <input type="submit" value="<?php echo $this->lang->line('add') ?>">
</form>
