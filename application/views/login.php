<?php
if ($this->session->flashdata('error')) {
    echo $this->session->flashdata('error');
}
?>

<?php echo validation_errors(); ?>

<?php echo form_open('connection/login'); ?>
    <label for="email"><?php echo $this->lang->line('email')?> :</label><input type="email" id="email" name="email" required="required">
    <label for="password"><?php echo $this->lang->line('password') ?> :</label><input type="password" id="password" name="password" required="required">
    <input type="submit" name="<?php echo $this->lang->line('connection') ?>">
</form>

<a href="<?php echo site_url('connection/create_account')?>"><?php echo $this->lang->line('create_account') ?></a>
<br/><br/>
<a href="<?php echo site_url()?>"><?php echo $this->lang->line('back') ?></a>