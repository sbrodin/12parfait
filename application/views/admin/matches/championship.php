<a href="<?= site_url('onarie/matches') ?>" class="btn btn-sm btn-outline-primary m-b-1"><?= $this->lang->line('back_to_matches_admin');?></a><br/>
<?= validation_errors() ?>

<?= form_open('onarie/matches/championship'); ?>
    <select id="championship" name="championship" required="required">
        <?php foreach ($championships as $key => $championship) : ?>
        <option value="<?= $championship->championship_id ?>" ><?= $championship->name ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="<?= $this->lang->line('choose_championship') ?>">
</form>
