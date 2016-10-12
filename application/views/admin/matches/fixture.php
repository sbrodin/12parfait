<a href="<?= site_url('admin/matches') ?>"><?= $this->lang->line('back_to_matches_admin') ?></a><br/>
<a href="<?= site_url('admin/fixtures/add') ?>"><?= $this->lang->line('add_fixture') ?></a><br/>
<?= validation_errors(); ?>

<?php if (!empty($info)) : ?>
    <span><?= $info ?></span>
<?php else : ?>
    <?= form_open('admin/matches/fixture') ?>
        <label for="championship"><?= $this->lang->line('championship') ?> : </label>
        <span id="championship"><?= $championship ?></span><br/>
        <label for="fixture"><?= $this->lang->line('fixture') ?> : </label>
        <select id="fixture" name="fixture" required="required">
            <?php foreach ($fixtures as $key => $fixture) : ?>
            <option value="<?= $fixture->fixture_id ?>" ><?= $fixture->fixture_name ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="<?= $this->lang->line('choose_fixture') ?>">
    </form>
<?php endif; ?>
