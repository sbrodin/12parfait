<?php
if ($this->session->flashdata('error')) {
    echo $this->session->flashdata('error');
}
?>

<?php echo validation_errors(); ?>

<?php echo form_open('forgotten_password'); ?>
    <label for="email"><?php echo $this->lang->line('email')?> : </label><input type="email" id="email" name="email" required="required">
    <input type="submit" name="submit" value="<?php echo $this->lang->line('reset_password') ?>">
</form>

<br/>
<a href="<?php echo site_url('connection')?>"><?php echo $this->lang->line('back') ?></a>