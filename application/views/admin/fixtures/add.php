<a href="<?= site_url('admin/fixtures') ?>" class="btn btn-sm btn-outline-primary m-b-1"><?= $this->lang->line('back_to_fixtures_admin');?></a><br/>
<?= validation_errors() ?>

<?= form_open('admin/fixtures/add') ?>
    <?php if (!empty($this->session->userdata('championship'))) : ?>
    <input type="hidden" id="championship" name="championship" value="<?= $this->session->userdata('championship') ?>">
    <?php else : ?>
    <label for="championship"><?= $this->lang->line('championship') ?> : </label>
    <select id="championship" name="championship" required="required">
        <?php foreach ($championships as $key => $championship) : ?>
        <option value="<?= $championship->championship_id ?>" 
            selected="<?= (!empty($this->session->userdata('championship')) && $this->session->userdata('championship') == $championship->championship_id) ? 'selected' : '' ?>" ><?= $championship->name ?></option>
        <?php endforeach; ?>
    </select><br/>
    <?php endif; ?>
    <label for="fixture_name"><?= $this->lang->line('fixture_name') ?> : </label>
    <input type="text" id="fixture_name" name="fixture_name" value="<?= set_value('fixture_name') ?>" required="required">
    <input type="submit" value="<?= $this->lang->line('add') ?>">
</form>
