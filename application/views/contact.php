<a class="btn btn-sm btn-secondary m-b-2" href="<?= site_url() ?>"><?= $this->lang->line('back') ?></a><br/>

<div class="m-b-2"><?= $this->lang->line('contact_message') ?></div>

<?= validation_errors() ?>

<?= form_open('contact', array('class' => 'form-contact')) ?>
    <label for="motif"><?= $this->lang->line('motif') ?> :</label>
    <select id="motif" name="motif" class="form-control m-b-2" required="required">
        <option value="<?= $this->lang->line('evolution') ?>"><?= $this->lang->line('idea_evolution') ?></option>
        <option value="<?= $this->lang->line('error_result') ?>"><?= $this->lang->line('error_result') ?></option>
        <option value="<?= $this->lang->line('critic') ?>"><?= $this->lang->line('critic') ?></option>
        <option value="<?= $this->lang->line('bug') ?>"><?= $this->lang->line('bug') ?></option>
        <option value="<?= $this->lang->line('other') ?>"><?= $this->lang->line('other') ?></option>
    </select>
    <label for="message"><?= $this->lang->line('your_message') ?> :</label>
    <textarea id="message" name="message" class="form-control m-b-2" rows="6" placeholder="<?= $this->lang->line('your_message') ?>" required="required"></textarea>

    <input type="submit" name="submit" class="btn btn-sm btn-primary m-b-2" value="<?= $this->lang->line('send_message') ?>">
    <a class="btn btn-sm btn-secondary m-b-2" href="<?= site_url('profile') ?>"><?= $this->lang->line('back') ?></a>
</form>