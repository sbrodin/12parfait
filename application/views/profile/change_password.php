<div class="container">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <a class="btn btn-sm btn-secondary m-b-2" href="<?= site_url('profile')?>"><?= $this->lang->line('back') ?></a>

        <?= validation_errors(); ?>

        <?= form_open('profile/change_password'); ?>
            <label for="password"><?= $this->lang->line('password') ?> : <span class="info"><?= $this->lang->line('password_rules') ?></span></label>
            <input type="password" id="password" name="password" class="form-control" placeholder="<?= $this->lang->line('password') ?>" required="required">
            <label for="password_confirmation"><?= $this->lang->line('password_confirmation') ?> : </label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="<?= $this->lang->line('password_confirmation') ?>" required="required"><br/>
            <input type="submit" class="btn btn-primary col-sm-5 m-b-2" value="<?= $this->lang->line('confirm') ?>">
        </form>
    </div>
    <div class="col-sm-1 clearfix"></div>
</div>
