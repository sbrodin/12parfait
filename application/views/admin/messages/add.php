<div class="container">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <a class="btn btn-sm btn-secondary m-b-2" href="<?= site_url('onarie/messages')?>"><?= $this->lang->line('back_to_messages_admin') ?></a>

        <?= validation_errors(); ?>

        <?= form_open('onarie/messages/add'); ?>
            <label for="message_name"><?= $this->lang->line('message_name') ?> : </label>
            <input type="text" id="message_name" name="message_name" class="form-control m-b-2" value="<?= set_value('message_name') ?>" required="required" autofocus>
            <label for="french_content"><?= $this->lang->line('french_content') ?> : </label>
            <textarea id="french_content" name="french_content" class="form-control m-b-2" required="required"><?= set_value('french_content') ?></textarea>
            <label for="english_content"><?= $this->lang->line('english_content') ?> : </label>
            <textarea id="english_content" name="english_content" class="form-control m-b-2" required="required"><?= set_value('english_content') ?></textarea>
            <input type="submit" class="btn btn-primary col-sm-5 m-b-2" value="<?= $this->lang->line('confirm') ?>">
        </form>
    </div>
    <div class="col-sm-3 clearfix"></div>
</div>