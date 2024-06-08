<a class="btn btn-sm btn-secondary m-b-2" href="<?= site_url() ?>"><?= $this->lang->line('back') ?></a><br/>

<?php if (isset($contact_message)) : ?>
    <div class="jumbotron">
        <?= $contact_message ?>
    </div>
<?php endif; ?>

<?= validation_errors() ?>

<?= form_open('contact', ['id' => 'form-contact']) ?>
    <label for="contact_name"><?= $this->lang->line('your_name') ?> :</label>
    <input id="contact_name" type="text" name="contact_name" class="form-control m-b-2" placeholder="<?= $this->lang->line('your_name') ?>" required="required"></input>
    <label for="motif"><?= $this->lang->line('motif') ?> :</label>
    <select id="motif" name="motif" class="form-control m-b-2" required="required">
        <option value="<?= $this->lang->line('evolution') ?>"><?= $this->lang->line('idea_evolution') ?></option>
        <option value="<?= $this->lang->line('error_result') ?>"><?= $this->lang->line('error_result') ?></option>
        <option value="<?= $this->lang->line('new_crypto_address') ?>"><?= $this->lang->line('new_crypto_address') ?></option>
        <option value="<?= $this->lang->line('critic') ?>"><?= $this->lang->line('critic') ?></option>
        <option value="<?= $this->lang->line('bug') ?>"><?= $this->lang->line('bug') ?></option>
        <option value="<?= $this->lang->line('other') ?>"><?= $this->lang->line('other') ?></option>
    </select>
    <label for="message"><?= $this->lang->line('your_message') ?> :</label>
    <textarea id="message" name="message" class="form-control m-b-2" rows="6" placeholder="<?= $this->lang->line('your_message') ?>" required="required"></textarea>

    <script src="https://www.google.com/recaptcha/api.js"></script>
    <input class="g-recaptcha" name="g-recaptcha-response" data-sitekey="<?= $this->config->item('recaptcha_public_key') ?>"></input>

    <script>
        function onSubmit(token) {
            document.getElementById("form-contact").submit();
        }
    </script>

    <input type="submit" name="submit" class="btn btn-sm btn-primary m-b-2 g-recaptcha" data-sitekey="reCAPTCHA_site_key" data-callback="onSubmit" data-action="submit" value="<?= $this->lang->line('send_message') ?>">
</form>
