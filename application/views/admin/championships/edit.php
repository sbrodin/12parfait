<a href="<?= site_url('admin/championships') ?>"><?= $this->lang->line('back_to_championships_admin') ?></a><br/>
<?= validation_errors() ?>

<?= form_open('admin/championships/edit/'.$championship->championship_id) ?>
    <label for="championship_name"><?= $this->lang->line('championship_name') ?> : </label><input type="text" id="championship_name" name="championship_name" value="<?= $championship->name ?>" required="required">
    <label for="sport"><?= $this->lang->line('sport') ?> : </label>
    <select id="sport" name="sport" required="required">
        <option value="<?= strtolower($this->lang->line('football')) ?>" <?= ($championship->country==strtolower($this->lang->line('football'))) ? 'selected' : '' ?> ><?= $this->lang->line('football') ?></option>
        <option value="<?= strtolower($this->lang->line('rugby')) ?>" <?= ($championship->country==strtolower($this->lang->line('rugby'))) ? 'selected' : '' ?> ><?= $this->lang->line('rugby') ?></option>
    </select>
    <label for="country"><?= $this->lang->line('country') ?> : </label>
    <select id="country" name="country" required="required">
        <option value="<?= strtolower($this->lang->line('france')) ?>" <?= ($championship->country==strtolower($this->lang->line('france'))) ? 'selected' : '' ?> ><?= $this->lang->line('france') ?></option>
        <option value="<?= strtolower($this->lang->line('europe')) ?>" <?= ($championship->country==strtolower($this->lang->line('europe'))) ? 'selected' : '' ?> ><?= $this->lang->line('europe') ?></option>
    </select>
    <label for="level"><?= $this->lang->line('level') ?> : </label>
    <select id="level" name="level" required="required">
        <option value="1" <?= ($championship->level==1) ? 'selected' : '' ?> >1</option>
        <option value="2" <?= ($championship->level==2) ? 'selected' : '' ?> >2</option>
    </select>
    <label for="year"><?= $this->lang->line('year') ?> : </label><input type="number" id="year" name="year" value="<?= $championship->year ?>" required="required" min="2015"><br/>
    <select id="teams" name="teams[]" multiple>
        <?php foreach ($teams as $key => $team) : ?>
        <option value="<?= $team->team_id ?>" <?= (array_search($team->team_id, $championship_teams)) ? 'selected' : '' ?> ><?= $team->name ?></option>
        <?php endforeach; ?>
    </select><br/>
    <input type="submit" value="<?= $this->lang->line('confirm') ?>">
</form>
