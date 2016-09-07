<?php
if ($this->session->flashdata('error')) {
    echo $this->session->flashdata('error');
}
if ($this->session->flashdata('info')) {
    echo $this->session->flashdata('info');
}
?>

<?php echo validation_errors(); ?>

<?php echo form_open('connection/login'); ?>
    <label for="email"><?php echo $this->lang->line('email')?> : </label>
    <input type="email" id="email" name="email" class="form-control" required="required" autofocus>
    <label for="password"><?php echo $this->lang->line('password') ?> : </label>
    <input type="password" id="password" name="password" class="form-control" required="required"><br/>
    <input type="submit" name="submit" class="btn btn-lg btn-primary btn-block" value="<?php echo $this->lang->line('log_in') ?>">
</form>

<a href="<?php echo site_url('connection/create_account')?>"><?php echo $this->lang->line('create_account') ?></a>
<br/>
<a href="<?php echo site_url('forgotten_password')?>"><?php echo $this->lang->line('forgotten_password') ?></a>
<br/><br/>
<a href="<?php echo site_url()?>"><?php echo $this->lang->line('back') ?></a>