<?php if ($this->session->flashdata('error')) : ?>
    <div class="alert alert-alert alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $this->session->flashdata('error') ?>
    </div>
<?php endif ?>

<?php echo validation_errors(); ?>

<?php echo form_open('forgotten_password'); ?>
    <label for="email"><?php echo $this->lang->line('email')?> : </label>
    <input type="email" id="email" name="email" class="form-control" required="required"><br/>
    <input type="submit" name="submit" class="btn btn-lg btn-primary btn-block" value="<?php echo $this->lang->line('reset_password') ?>">
</form>

<br/>
<a href="<?php echo site_url('connection')?>"><?php echo $this->lang->line('back') ?></a>