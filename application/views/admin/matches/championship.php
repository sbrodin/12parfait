<a href="<?= site_url('admin/matches') ?>"><?= $this->lang->line('back_to_matches_admin') ?></a><br/>
<?= validation_errors() ?>

<?= form_open('admin/matches/championship'); ?>
    <select id="championship" name="championship" required="required">
        <?php foreach ($championships as $key => $championship) : ?>
        <option value="<?= $championship->championship_id ?>" ><?= $championship->name ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="<?= $this->lang->line('choose_championship') ?>">
</form>
