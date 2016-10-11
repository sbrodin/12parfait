<?php if ($this->session->flashdata('error')) : ?>
    <div class="alert alert-alert alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $this->session->flashdata('error') ?>
    </div>
<?php endif ?>
<?php if ($this->session->flashdata('info')) : ?>
    <div class="alert alert-info alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $this->session->flashdata('info') ?>
    </div>
<?php endif ?>

<div class="container">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <a class="btn btn-sm btn-outline-primary m-b-2" href="<?php echo site_url()?>"><?php echo $this->lang->line('back') ?></a>

        <?php echo validation_errors(); ?>

        <?php echo form_open('connection/login'); ?>
            <label for="email"><?php echo $this->lang->line('email')?> : </label>
            <input type="email" id="email" name="email" class="form-control m-b-1" required="required" autofocus>
            <label for="password"><?php echo $this->lang->line('password') ?> : </label>
            <input type="password" id="password" name="password" class="form-control" required="required"><br/>
            <input type="submit" name="submit" class="btn btn-lg btn-primary col-md-5 m-b-2" value="<?php echo $this->lang->line('log_in') ?>">
            <div class="col-md-2"></div>
            <a class="btn btn-secondary col-md-5" href="<?php echo site_url('forgotten_password')?>"><?php echo $this->lang->line('forgotten_password') ?></a>
        </form>

        <div class="clearfix"></div>

        <a class="btn btn-lg btn-outline-primary col-md-5" href="<?php echo site_url('connection/create_account')?>"><?php echo $this->lang->line('create_account') ?></a>
    </div>
    <div class="col-md-3 clearfix"></div>
</div>