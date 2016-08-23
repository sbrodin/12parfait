<a href="<?php echo site_url('admin') ?>"><?php echo $this->lang->line('back_to_site_admin') ?></a><br/>
<a href="<?php echo site_url('admin/matches') ?>"><?php echo $this->lang->line('back_to_matches_admin') ?></a><br/>
<a href="<?php echo site_url('admin/fixtures/add') ?>"><?php echo $this->lang->line('add_fixture');?></a><br/>
<?php echo validation_errors(); ?>

<?php echo form_open('admin/matches/fixture'); ?>
    <label for="championship"><?php echo $this->lang->line('championship') ?> : </label>
    <span id="championship"><?php echo $championship ?></span><br/>
    <label for="fixture"><?php echo $this->lang->line('fixture') ?> : </label>
    <select id="fixture" name="fixture" required="required">
        <?php foreach ($fixtures as $key => $fixture) : ?>
        <option value="<?php echo $fixture->fixture_id ?>" ><?php echo $fixture->fixture_name ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="<?php echo $this->lang->line('choose_fixture') ?>">
</form>
