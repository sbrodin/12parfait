<a href="<?= site_url('admin/championships') ?>" class="btn btn-sm btn-outline-primary m-b-1"><?= $this->lang->line('back_to_championships_admin');?></a><br/>
<?= validation_errors() ?>

<?= form_open('admin/championships/add') ?>
    <div>
        <label for="championship_name"><?= $this->lang->line('championship_name') ?> : </label>
        <input type="text" id="championship_name" name="championship_name" required="required">
    </div>
    <div>
        <label for="sport"><?= $this->lang->line('sport') ?> : </label>
        <select id="sport" name="sport" required="required">
            <option value="<?= strtolower($this->lang->line('football')) ?>"><?= $this->lang->line('football') ?></option>
            <option value="<?= strtolower($this->lang->line('rugby')) ?>"><?= $this->lang->line('rugby') ?></option>
        </select>
    </div>
    <div>
        <label for="country"><?= $this->lang->line('country') ?> : </label>
        <select id="country" name="country" required="required">
            <option value="<?= strtolower($this->lang->line('france')) ?>"><?= $this->lang->line('france') ?></option>
            <option value="<?= strtolower($this->lang->line('europe')) ?>"><?= $this->lang->line('europe') ?></option>
            <option value="<?= strtolower($this->lang->line('world')) ?>"><?= $this->lang->line('world') ?></option>
        </select>
    </div>
    <div>
        <label for="level"><?= $this->lang->line('level') ?> : </label>
        <select id="level" name="level" required="required">
            <option value="1">1</option>
            <option value="2">2</option>
        </select>
    </div>
    <div>
        <label for="year"><?= $this->lang->line('year') ?> : </label>
        <input type="number" id="year" name="year" required="required" min="2018">
    </div>
    <input type="submit" value="<?= $this->lang->line('add') ?>">
</form>
