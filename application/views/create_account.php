<?= validation_errors(); ?>

<?= form_open('connection/create_account'); ?>
    <label for="email"><?= $this->lang->line('email') ?> : </label>
    <input type="email" id="email" name="email" class="form-control" value="<?= set_value('email'); ?>" required="required">
    <label for="password"><?= $this->lang->line('password') ?> : <span class="info"><?= $this->lang->line('password_rules') ?></span></label>
    <input type="password" id="password" name="password" class="form-control" required="required">
    <label for="password_confirmation"><?= $this->lang->line('password_confirmation') ?> : </label>
    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required="required"><br/>
    <input type="submit" class="btn btn-lg btn-primary btn-block" value="Valider">
</form>

<br/>
<a href="<?= site_url('connection')?>"><?= $this->lang->line('back') ?></a>