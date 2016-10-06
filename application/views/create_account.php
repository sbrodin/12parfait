<?php echo validation_errors(); ?>

<?php echo form_open('connection/create_account'); ?>
    <label for="email"><?php echo $this->lang->line('email') ?> : </label>
    <input type="email" id="email" name="email" class="form-control" value="<?php echo set_value('email'); ?>" required="required">
    <label for="password"><?php echo $this->lang->line('password') ?> : <span class="info"><?php echo $this->lang->line('password_rules') ?></span></label>
    <input type="password" id="password" name="password" class="form-control" required="required">
    <label for="password_confirmation"><?php echo $this->lang->line('password_confirmation') ?> : </label>
    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required="required"><br/>
    <input type="submit" class="btn btn-lg btn-primary btn-block" value="Valider">
</form>

<br/>
<a href="<?php echo site_url('connection')?>"><?php echo $this->lang->line('back') ?></a>