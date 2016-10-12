<?php if ($this->session->flashdata('error')) : ?>
    <div class="alert alert-alert alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?= $this->session->flashdata('error') ?>
    </div>
<?php endif ?>

<?= validation_errors(); ?>

<?= form_open('forgotten_password'); ?>
    <label for="email"><?= $this->lang->line('email')?> : </label>
    <input type="email" id="email" name="email" class="form-control" required="required"><br/>
    <input type="submit" name="submit" class="btn btn-lg btn-primary btn-block" value="<?= $this->lang->line('reset_password') ?>">
</form>

<br/>
<a href="<?= site_url('connection')?>"><?= $this->lang->line('back') ?></a>