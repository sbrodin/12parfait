<a href="<?php echo site_url('admin/matches') ?>"><?php echo $this->lang->line('back_to_matches_admin') ?></a><br/>
<?php echo validation_errors(); ?>

<?php echo form_open('admin/matches/championship'); ?>
    <select id="championship" name="championship" required="required">
        <?php foreach ($championships as $key => $championship) : ?>
        <option value="<?php echo $championship->championship_id ?>" ><?php echo $championship->name ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="<?php echo $this->lang->line('choose_championship') ?>">
</form>
