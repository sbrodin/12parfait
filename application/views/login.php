<div class="container">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <?php if ($this->session->flashdata('error')) : ?>
            <div class="alert alert-alert alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif ?>
        <?php if ($this->session->flashdata('info')) : ?>
            <div class="alert alert-info alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?= $this->session->flashdata('info') ?>
            </div>
        <?php endif ?>
        <a class="btn btn-sm btn-secondary m-b-2" href="<?= site_url()?>"><?= $this->lang->line('back') ?></a>

        <a class="btn btn-outline-primary pull-xs-right" href="<?= site_url('connection/create_account')?>"><?= $this->lang->line('create_account') ?></a>

        <?= validation_errors() ?>

        <?= form_open('connection/login?url=' . $url) ?>
            <label for="email"><?= $this->lang->line('email') ?> : </label>
            <input type="email" id="email" name="email" class="form-control m-b-1" placeholder="<?= $this->lang->line('email') ?>" required="required" autofocus>
            <label for="password"><?= $this->lang->line('password') ?> : </label>
            <input type="password" id="password" name="password" class="form-control" placeholder="<?= $this->lang->line('password') ?>" required="required"><br/>
            <input type="submit" name="submit" class="btn btn-primary col-md-5 m-b-2" value="<?= $this->lang->line('log_in') ?>">
            <div class="col-sm-2"></div>
            <a class="btn btn-link col-lg-5" href="<?= site_url('forgotten_password') ?>"><?= $this->lang->line('forgotten_password') ?></a>
        </form>
    </div>
    <div class="col-sm-1 clearfix"></div>
</div>