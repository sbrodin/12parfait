<div class="container">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <?php if ($this->session->flashdata('error')) : ?>
            <div class="alert alert-alert alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif ?>

        <a class="btn btn-sm btn-secondary m-b-2" href="<?= site_url('connection')?>"><?= $this->lang->line('back') ?></a>

        <?= validation_errors(); ?>

        <?= form_open('forgotten_password'); ?>
            <label for="email"><?= $this->lang->line('email')?> : </label>
            <input type="email" id="email" name="email" class="form-control" placeholder="<?= $this->lang->line('email') ?>" required="required"><br/>
            <input type="submit" name="submit" class="btn btn-primary col-sm-5 m-b-2" value="<?= $this->lang->line('reset_password') ?>">
        </form>
    </div>
    <div class="col-sm-3 clearfix"></div>
</div>